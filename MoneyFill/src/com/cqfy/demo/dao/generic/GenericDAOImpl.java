package com.cqfy.demo.dao.generic;

import java.io.Serializable;

import java.util.ArrayList;
import java.util.List;

import org.hibernate.HibernateException;
import org.hibernate.Query;
import org.hibernate.Session;
import org.hibernate.SessionFactory;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.orm.hibernate3.HibernateCallback;
import org.springframework.orm.hibernate3.support.HibernateDaoSupport;
import org.springframework.transaction.annotation.Transactional;

/**
 * 
 * @Author LangYu
 */
@Transactional
public class GenericDAOImpl<T> extends HibernateDaoSupport implements
		GenericDAO<T> {

	private Class<T> clazz;

	@Autowired
	public void setSessionFactoryOne(SessionFactory sessionFactory) {
		super.setSessionFactory(sessionFactory);
	}

	public GenericDAOImpl(Class<T> clazz) {
		this.clazz = clazz;
	}

	@Override
	@Transactional
	public T read(Serializable id) {
		if (id == null)
			return null;
		return (T) this.getHibernateTemplate().get(clazz, id);
	}

	public void setClazzType(Class<T> clazz) {
		this.clazz = clazz;
	}

	public Class<T> getClazzType() {
		return this.clazz;
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public int batchUpdate(final String HQL, final Object[] params) {
		Object set = this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						Query query = session.createQuery(HQL);
						int parameterIndex = 0;
						if (params != null && params.length > 0) {
							for (Object object : params) {
								query.setParameter(parameterIndex++, object);
							}
						}
						return query.executeUpdate();
					}
				});
		return (Integer) set;
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public int executeNativeSQL(final String NNQ) {
		Object set = this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						Query query = session.createSQLQuery(NNQ).addEntity(
								clazz);
						return query.executeUpdate();
					}
				});
		return (Integer) set;
	}

	@SuppressWarnings("unchecked")
	protected Object queryForObject(final String select, final Object[] values) {
		HibernateCallback selectCallback = new HibernateCallback() {
			public Object doInHibernate(Session session) {
				Query query = session.createQuery(select);
				if (values != null) {
					for (int i = 0; i < values.length; i++)
						query.setParameter(i, values[i]);
				}
				return query.uniqueResult();
			}
		};
		return this.getHibernateTemplate().execute(selectCallback);
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public List<T> find(final String queryString, final Object[] params,
			final int begin, final int max) {
		List<T> set = (List<T>) this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						String clazzName = clazz.getName();
						StringBuffer buffer = new StringBuffer(
								" select obj from ");
						buffer.append(clazzName).append(" obj").append(
								" where ").append(queryString);
						Query query = session.createQuery(buffer.toString());
						int parameterIndex = 0;
						if (params != null && params.length > 0) {
							for (Object object : params) {
								query.setParameter(parameterIndex++, object);
							}
						}
						if (begin >= 0 && max > 0) {
							query.setFirstResult(begin);
							query.setMaxResults(max);
						}
						return query.list();
					}
				});
		if (set != null && set.size() >= 0) {
			return set;
		} else {
			return new ArrayList<T>();
		}
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public void flush() {
		this.getHibernateTemplate().execute(new HibernateCallback() {
			public Object doInHibernate(Session session)
					throws HibernateException {
				session.getTransaction().commit();
				return null;
			}
		});
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public T getBy(final String propertyName, final Object value) {
		if (propertyName == null || "".equals(propertyName) || value == null)
			throw new IllegalArgumentException(
					"Call parameter is not correct attribute names and values are not empty in getBy");
		List<T> set = (List<T>) this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						String clazzName = clazz.getName();
						StringBuffer buffer = new StringBuffer(
								" select obj from ");
						buffer.append(clazzName).append(" obj");
						Query query = null;
						if (propertyName != null && value != null) {
							buffer.append(" where obj.").append(propertyName)
									.append(" = :value ");
							query = session.createQuery(buffer.toString())
									.setParameter("value", value);
						} else {
							query = session.createQuery(buffer.toString());
						}
						return query.list();
					}
				});

		if (set != null && set.size() == 1) {
			return set.get(0);
		} else if (set != null && set.size() > 1) {
			throw new IllegalStateException("More than one object find!");
		} else {
			return null;
		}
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public List query(final String queryString, final Object[] params,
			final int begin, final int max) {
		List set = (List) this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						Query query = session.createQuery(queryString);
						int parameterIndex = 0;
						if (params != null && params.length > 0) {
							for (Object object : params) {
								query.setParameter(parameterIndex++, object);
							}
						}
						if (begin >= 0 && max > 0) {
							query.setFirstResult(begin);
							query.setMaxResults(max);
						}
						return query.list();
					}
				});
		if (set != null && set.size() >= 0) {
			return set;
		} else {
			return new ArrayList();
		}
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public List queryNativeSQL(final String NSQL, final Object[] params,
			final int begin, final int max) {
		List set = (List) this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						Query query = session.createSQLQuery(NSQL).addEntity(
								clazz);
						int parameterIndex = 0;
						if (params != null && params.length > 0) {
							for (Object object : params) {
								query.setParameter(parameterIndex++, object);
							}
						}
						if (begin >= 0 && max > 0) {
							query.setFirstResult(begin);
							query.setMaxResults(max);
						}
						return query.list();
					}
				});
		if (set != null && set.size() >= 0) {
			return set;
		} else {
			return new ArrayList();
		}
	}

	@Override
	@Transactional
	@SuppressWarnings("unchecked")
	public List queryNativeSQL(final String NSQL) {

		Object set = this.getHibernateTemplate().execute(
				new HibernateCallback() {
					public Object doInHibernate(Session session)
							throws HibernateException {
						Query query = session.createSQLQuery(NSQL).addEntity(
								clazz);
						return query.list();
					}
				});
		return (List) set;

	}

	@Override
	@Transactional
	public void remove(Serializable id) throws GenericException {
		if (id == null)
			throw new IllegalArgumentException(
					"ID value can not be empty in removing...");
		T object = this.read(id);
		if (object != null) {
			try {
				this.getHibernateTemplate().delete(object);
			} catch (Exception e) {
				throw new GenericException();
			}
		}
	}

	@Override
	@Transactional
	public void save(T newInstance) {
		this.getHibernateTemplate().save(newInstance);
	}

	@Override
	@Transactional
	public void update(T transientObject) {
		this.getHibernateTemplate().merge(transientObject);
	}

}
