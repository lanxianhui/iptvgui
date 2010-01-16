package com.cqfy.demo.dao.generic;

import java.io.Serializable;
import java.util.List;

import com.cqfy.demo.util.PagingInfo;

/**
 * 
 * @author LangYu
 *
 */
public interface GenericDAO<T>{
	

	void save(T newInstance);
	
	T read(Serializable id);
	
	void update(T transientObject);
	
	void remove(Serializable id);
	
	T getBy(String propertyName,Object value);
	
	List<T> find(final String queryString,final Object[] params,final int begin,final int max);
	
	List<T> find(final String countString,final String queryString,final Object[] params,PagingInfo pagingInfo);

	@SuppressWarnings("unchecked")
	List query(final String queryString,final Object[] params,final int begin,final int max);
	
	int batchUpdate(String HQL,Object[] params);

	@SuppressWarnings("unchecked")
	List queryNativeSQL(String NSQL);
	
	@SuppressWarnings("unchecked")
	List queryNativeSQL(final String NSQL,final Object[] params,final int begin,final int max);

	public int executeNativeSQL(final String NNQ);
	
	public void flush();
}
