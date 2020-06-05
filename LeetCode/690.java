import java.util.List;

class Employee
{
    public int id;
    public int importance;
    public List<Integer> subordinates;
};


class Solution
{
    public int getImportance(List<Employee> employees, int id) {
        if (employees.isEmpty()) return 0;
        Employee curr = null;
        for (Employee employee : employees) {
            if (employee.id == id) {
                curr = employee;
                break;
            }
        }
        if (curr == null) return 0;
        int importance = curr.importance;
        for (int subId : curr.subordinates) {
            importance += getImportance(employees, subId);
        }
        return importance;
    }
}
