-- 解法1
select email from person group by email having count(email)>1

--解法2
select email from (select count(1) as t,email from person group by email)r  where r.t>1;

--解法3
select distinct(p1.Email) from Person p1  
join Person  p2 on p1.Email = p2.Email AND p1.Id!=p2.Id