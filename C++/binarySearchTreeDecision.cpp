#include <bits/stdc++.h>

using namespace std;

struct TreeNode
{
    int val;
    TreeNode *left;
    TreeNode *right;
    TreeNode(int x) : val(x), left(NULL), right(NULL) {}
};

void inOrder(TreeNode *root, vector<int> *arr)
{
    if (root == 0)
        return;
    inOrder(root->left, arr);
    arr->push_back(root->val);
    inOrder(root->right, arr);
}

bool isBinarySearchTree(int n, TreeNode *root)
{
    vector<int> res;
    inOrder(root, &res);
    for (int i = 1; i < res.size(); i++)
        if (res[i - 1] > res[i])
            return false;
    return true;
}

int main(void)
{
    int n, r;
    scanf("%d%d", &n, &r);
    TreeNode *tree, *root;
    tree = (TreeNode *)malloc(sizeof(TreeNode) * (n + 1));
    root = &tree[r];
    for (int i = 1; i <= n; i++)
    {
        int v, l, r;
        scanf("%d%d%d", &v, &l, &r);
        tree[i].val = v;
        tree[i].left = l ? &tree[l] : 0;
        tree[i].right = r ? &tree[r] : 0;
    }
    printf(isBinarySearchTree(n, root) ? "true\n" : "false\n");
    return 0;
}
