SELECT p.FirstName, p.LastName, a.City, a.State
FROM person p
LEFT JOIN ADDRESS a
ON p.personid=a.personid

SELECT P.FirstName,P.LastName,A.City,A.State
FROM Person P
LEFT JOIN
    (SELECT DISTINCT PersonId,City,State FROM Address) A
ON P.PersonId = A.PersonId