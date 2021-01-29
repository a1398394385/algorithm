import java.util.ArrayList;
import java.util.HashMap;
import java.util.HashSet;
import java.util.List;
import java.util.Map;
import java.util.Set;

class Solution
{
    static class TrieNode
    {
        String name;
        boolean isEnd = false;
        Map<String, TrieNode> children = new HashMap<>();

        TrieNode(String name) {
            this.name = name;
        }
    }

    public List<String> result = new ArrayList<>();

    public List<String> removeSubfolders(String[] folder) {
        Map<String, TrieNode> map = new HashMap<>();
        for (String path : folder) {
            if (path.length() < 1) continue;
            String[] subFolder = path.split("/");
            if (map.containsKey(subFolder[1]) == false)
                map.put(subFolder[1], new TrieNode(subFolder[1]));
            TrieNode root = map.get(subFolder[1]);
            for (int i = 2; i < subFolder.length; i++) {
                if (root.children.containsKey(subFolder[i]) == false)
                    root.children.put(subFolder[i], new TrieNode(subFolder[i]));
                root = root.children.get(subFolder[i]);
            }
            root.isEnd = true;
        }
        dfs(new StringBuilder(), map);
        return result;
    }

    public void dfs(StringBuilder path, Map<String, TrieNode> folder) {
        folder.forEach((key, value) -> {
            int length = path.length();
            path.append("/").append(value.name);
            if (value.isEnd)
                result.add(path.toString());
            else
                dfs(path, value.children);
            path.delete(length, path.length());
        });
    }

    public void dfs1(String path, Map<String, TrieNode> folder) {
        folder.forEach((key, value) -> {
            if (value.isEnd)
                result.add(path + "/" + value.name);
            else
                dfs1(path + "/" + value.name, value.children);
        });
    }

    public List<String> removeSubfolders1(String[] folder) {
        Set<String> set = new HashSet<>();
        for (String f : folder)
            set.add(f);

        List<String> res = new ArrayList<>();
        for (String f : folder) {
            int size = f.length();
            boolean hasParent = false;
            for (int i = 1; i < size; i++) {
                if (f.charAt(i) == '/') {
                    if (set.contains(f.substring(0, i))) {
                        hasParent = true;
                        break;
                    }
                }
            }
            if (!hasParent) res.add(f);
        }
        return res;
    }
}
