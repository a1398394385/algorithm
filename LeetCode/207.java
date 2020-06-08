import java.util.ArrayList;
import java.util.LinkedList;
import java.util.List;
import java.util.Queue;

class Solution
{
    public boolean canFinish(int numCourses, int[][] prerequisites) {
        boolean[] isChildArr = new boolean[numCourses];
        int[] fatherNumber = new int[numCourses];
        List<List<Integer>> tree = new ArrayList<>();
        for (int i = 0; i < numCourses; i++)
            tree.add(new ArrayList<>());
        for (int i = 0, len = prerequisites.length; i < len; i++) {
            int child = prerequisites[i][0], father = prerequisites[i][1];
            isChildArr[child] = true;
            fatherNumber[child]++;
            tree.get(father).add(child);
        }
        Queue<Integer> queue = new LinkedList<>();
        for (int i = 0; i < numCourses; i++)
            if (isChildArr[i] == false)
                queue.add(i);
        while (queue.isEmpty() == false) {
            int father = queue.poll();
            for (int child : tree.get(father)) {
                if (--fatherNumber[child] == 0)
                    queue.add(child);
            }
        }
        for (int i = 0; i < numCourses; i++)
            if (fatherNumber[i] != 0)
                return false;

        return true;
    }
}
