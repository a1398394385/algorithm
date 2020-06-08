import java.util.ArrayList;
import java.util.List;

class Solution
{
    public int[] parent;

    public boolean equationsPossible(String[] equations) {
        if (equations.length == 0) return true;
        parent = new int[26];
        for (int i = 0; i < 26; i++)
            parent[i] = i;

        List<String> temp = new ArrayList<>();
        for (String equation : equations) {
            if (equation.charAt(1) == '=') {
                int parent1 = find(equation.charAt(0) - 'a'), parent2 = find(equation.charAt(3) - 'a');
                if (parent1 != parent2)
                    parent[parent1] = parent2;
            } else {
                temp.add(equation);
            }
        }

        for (String equation : temp) {
            if (find(equation.charAt(0) - 'a') == find(equation.charAt(3) - 'a'))
                return false;
        }

        return true;
    }

    public boolean equationsPossible1(String[] equations) {
        if (equations.length == 0) return true;
        for (int i = 0; i < 26; i++)
            parent[i] = i;

        for (String equation : equations) {
            if (equation.charAt(1) == '=') {
                int parent1 = find(equation.charAt(0) - 'a'), parent2 = find(equation.charAt(3) - 'a');
                if (parent1 != parent2)
                    parent[parent1] = parent2;
            }
        }

        for (String equation : equations) {
            if (equation.charAt(1) == '!')
                if (find(equation.charAt(0) - 'a') == find(equation.charAt(3) - 'a'))
                    return false;
        }

        return true;
    }

    public int find(int child) {
        if (parent[child] != child)
            parent[child] = find(parent[child]);
        return parent[child];
    }

}
