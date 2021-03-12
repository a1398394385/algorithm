class Solution
{
    /**
     * 树的入度, 出度是一样的, 根节点入度=0出度=2,普通节点入度=1出度=2, 叶子节点入度=1出度=0
     */
    public boolean isValidSerialization(String preorder) {
        // 记录出度, 根节点出度多1
        int degree = 1;
        for (String s : preorder.split(",")) {
            if (degree == 0) return false;
            if ("#".equals(s))
                degree--;
            else
                degree++;
        }
        return degree == 0;
    }

    public boolean isValidSerialization1(String preorder) {
        // 记录叶子节点的个数
        int num = 0;
        String[] nodes = preorder.split(",");
        for (int i = nodes.length - 1; i >= 0; i--) {
            if ("#".equals(nodes[i])) {
                num++;
            } else {
                // 叶子节点的个数>=2, 消除2个叶子节点, 消除一个普通节点, 并将其转换成叶子节点
                if (num >= 2)
                    num--;
                else
                    return false;
            }
        }
        // 最终叶子节点的个数须 = 1
        return num == 1;
    }
}
