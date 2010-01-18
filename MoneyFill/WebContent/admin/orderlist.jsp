<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@ taglib prefix="c" uri="http://java.sun.com/jsp/jstl/core"%>
<%@ taglib prefix="spring" uri="http://www.springframework.org/tags" %>
<%@ taglib prefix="form" uri="http://www.springframework.org/tags/form" %>
[
<c:forEach items="${ajaxOrders}" var="item">
{"LineNumber":"${item.lineNumber}",
"CardNumber":"${item.cardNumber}",
"Price":"${item.price}",
"StatusStr":"${item.statusString}",
"CreateTime":"${item.createTime}",
"ID":"${item.id}"},
</c:forEach>
]