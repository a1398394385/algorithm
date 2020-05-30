import java.util.AbstractList;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Collections;
import java.util.HashMap;
import java.util.List;
import java.util.Map;
import java.util.Set;
import java.util.TreeSet;

class Solution
{
    public static List<List<String>> displayTable(List<List<String>> orders) {
        List<List<String>> result = new ArrayList<>();
        Set<String> set = new TreeSet<>();
        Map<String, List<String>> map = new HashMap<>();
        orders.forEach((order) -> {
            set.add(order.get(2));
            List<String> list = map.getOrDefault(order.get(1), new ArrayList<>());
            list.add(order.get(2));
            map.put(order.get(1), list);
        });
        List<String> table = new ArrayList<>();
        table.add("Table");
        table.addAll(set);
        map.forEach((key, value) -> {
            String[] menu = new String[table.size()];
            Arrays.fill(menu, "0");
            menu[0] = key;
            for (String dish : value) {
                int index = table.indexOf(dish);
                menu[index] = "" + (Integer.parseInt(menu[index]) + 1);
            }
            result.add(Arrays.asList(menu));
        });
        result.sort((value1, value2) -> {
            return Integer.parseInt(value1.get(0)) - Integer.parseInt(value2.get(0));
        });
        result.add(0, table);
        return result;
    }

    public List<List<String>> displayTable1(List<List<String>> orders) {
        Map<Integer, Map<String, Integer>> map = new HashMap<>();
        List<List<String>> ans = new ArrayList<>();
        Set<String> food = new TreeSet<>();
        Set<Integer> idx = new TreeSet<>();
        for (List<String> o : orders) {
            Integer i = Integer.parseInt(o.get(1));
            String f = o.get(2);
            if (!map.containsKey(i)) {
                map.put(i, new HashMap<>());
            }
            map.get(i).put(f, map.get(i).getOrDefault(f, 0) + 1);
            food.add(f);
            idx.add(i);
        }
        List<String> title = new ArrayList<>();
        title.add("Table");
        title.addAll(food);
        ans.add(title);
        for (Integer i : idx) {
            List<String> tmp = new ArrayList<>();
            tmp.add("" + i);
            for (String s : food) {
                tmp.add("" + map.get(i).getOrDefault(s, 0));
            }
            ans.add(tmp);
        }
        return ans;
    }

    public static void main(String[] args) {
        List<List<String>> orders = new ArrayList<>();
        orders.add(Arrays.asList(new String[] {"CWdAM", "10", " FlzD"}));
        orders.add(Arrays.asList(new String[] {" T", "17", "ok"}));
        orders.add(Arrays.asList(new String[] {"hai ", "17", "BlXft"}));
        orders.add(Arrays.asList(new String[] {"cTIg", "15", "MAvix"}));
        orders.add(Arrays.asList(new String[] {"jxK", "9", " FlzD"}));
        orders.add(Arrays.asList(new String[] {"vqkCX", "14", "pLg"}));
        orders.add(Arrays.asList(new String[] {"qwqB", "3", "yPsk"}));
        orders.add(Arrays.asList(new String[] {"YR", "15", "zG"}));
        orders.add(Arrays.asList(new String[] {"ovex", "11", "pLg"}));
        orders.add(Arrays.asList(new String[] {"zHeWJ", "14", "TdmVi"}));
        orders.add(Arrays.asList(new String[] {"L ", "9", "Ey"}));
        orders.add(Arrays.asList(new String[] {"lyS", "14", "zG"}));
        orders.add(Arrays.asList(new String[] {"vasR", "14", "ok"}));
        orders.add(Arrays.asList(new String[] {"NtfZt", "14", "yPsk"}));
        orders.add(Arrays.asList(new String[] {"IN", "5", "xau"}));
        orders.add(Arrays.asList(new String[] {"GQ", "5", "bcr"}));

        List<List<String>> result = Solution.displayTable(orders);
        result.forEach(System.out::println);
    }
}
