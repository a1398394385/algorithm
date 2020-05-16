select (select distinct salary from Employee order by salary desc limit 1,1) as SecondHighestSalary 

select max(Salary) SecondHighestSalary
from employee
where
salary < ( select max(salary) from employee )