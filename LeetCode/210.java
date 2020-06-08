import java.util.ArrayList;
import java.util.Arrays;
import java.util.HashMap;
import java.util.LinkedList;
import java.util.List;
import java.util.Map;
import java.util.Queue;

class Solution
{
    public Map<Integer, List<Integer>> map;
    public int[] fatherNumber;
    public List<Integer> result;

    public int[] findOrder(int numCourses, int[][] prerequisites) {
        fatherNumber = new int[numCourses];
        map = new HashMap<>();
        result = new ArrayList<>();
        boolean[] isChildArr = new boolean[numCourses];
        for (int i = 0, len = prerequisites.length; i < len; i++) {
            int child = prerequisites[i][0], father = prerequisites[i][1];
            isChildArr[child] = true;
            fatherNumber[child]++;
            if (map.containsKey(father) == false)
                map.put(father, new ArrayList<>());
            map.get(father).add(child);
        }
        List<Integer> list = new ArrayList<>();
        for (int i = 0; i < numCourses; i++)
            if (isChildArr[i] == false)
                list.add(i);
        bfs(list);
        if (Arrays.stream(fatherNumber).sum() == 0)
            for (Integer integer : list)
                dfs(integer);
        return result.stream().mapToInt(Integer::valueOf).toArray();
        // for (int i = 0; i < numCourses; i++)
        // if (fatherNumber[i] != 0)
        // return new int[0];
    }

    public void bfs(List<Integer> fathers) {
        List<Integer> list = new ArrayList<>();
        for (Integer father : fathers) {
            if (map.containsKey(father))
                for (int child : map.get(father))
                    if (--fatherNumber[child] == 0)
                        list.add(child);
        }
        if (list.isEmpty() == false) bfs(list);
    }

    public void dfs(int father) {
        if (result.contains(father))
            result.remove((Integer) father);
        result.add(father);
        if (map.containsKey(father))
            for (int child : map.get(father))
                dfs(child);
    }
}


class Solution1
{
    public int[] findOrder(int numCourses, int[][] prerequisites) {
        int[] fatherNumber = new int[numCourses];
        Map<Integer, List<Integer>> map = new HashMap<>();

        for (int i = 0, len = prerequisites.length; i < len; i++) {
            int child = prerequisites[i][0], father = prerequisites[i][1];
            fatherNumber[child]++;
            if (map.containsKey(father) == false)
                map.put(father, new ArrayList<>());
            map.get(father).add(child);
        }

        Queue<Integer> queue = new LinkedList<>();
        for (int i = 0; i < numCourses; i++)
            if (fatherNumber[i] == 0)
                queue.add(i);

        int index = 0;
        int[] result = new int[numCourses];
        Arrays.fill(result, -1);
        while (queue.isEmpty() == false) {
            int father = queue.poll();
            result[index++] = father;
            if (map.containsKey(father))
                for (int chile : map.get(father))
                    if (--fatherNumber[chile] == 0)
                        queue.add(chile);
        }

        if (result[numCourses - 1] == -1) return new int[0];
        return result;
    }

    public int[] findOrder1(int numCourses, int[][] prerequisites) {
        int[] fatherNumber = new int[numCourses];
        ArrayList<Integer>[] map = new ArrayList[numCourses];
        for (int i = 0; i < numCourses; i++)
            map[i] = new ArrayList<>();

        for (int i = 0, len = prerequisites.length; i < len; i++) {
            int child = prerequisites[i][0], father = prerequisites[i][1];
            fatherNumber[child]++;
            map[father].add(child);
        }

        Queue<Integer> queue = new LinkedList<>();
        for (int i = 0; i < numCourses; i++)
            if (fatherNumber[i] == 0)
                queue.add(i);

        int index = 0;
        int[] result = new int[numCourses];
        Arrays.fill(result, -1);
        while (queue.isEmpty() == false) {
            int father = queue.poll();
            result[index++] = father;
            for (int chile : map[father])
                if (--fatherNumber[chile] == 0)
                    queue.add(chile);
        }

        if (result[numCourses - 1] == -1) return new int[0];
        return result;
    }
}


class Solution2
{
    int[] flag;
    int index = 0;

    public int[] findOrder(int numCourses, int[][] prerequisites) {

        if (numCourses == 0) { return new int[] {}; }

        flag = new int[numCourses];

        ArrayList<Integer>[] courses = new ArrayList[numCourses];
        for (int i = 0; i < numCourses; i++) {
            courses[i] = new ArrayList();
        }
        for (int[] pre : prerequisites) {
            courses[pre[0]].add(pre[1]);
        }

        int[] orders = new int[numCourses];
        for (int i = 0; i < numCourses; i++) {
            if (!addCourse(orders, courses, i)) { return new int[] {}; }
        }

        return orders;
    }

    public boolean addCourse(int[] orders, ArrayList<Integer>[] courses, int i) {
        if (flag[i] == 2) { return true; }
        flag[i] = 1;
        int n = courses[i].size();
        for (int j = 0; j < n; j++) {
            int preNo = courses[i].get(j);
            if (flag[preNo] == 1) { return false; }
            if (!addCourse(orders, courses, preNo)) { return false; }
        }
        orders[index++] = i;
        flag[i] = 2;
        return true;
    }
}
