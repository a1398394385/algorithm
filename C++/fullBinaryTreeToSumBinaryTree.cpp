#include <bits/stdc++.h>

using namespace std;

int sumTree(vector<int> dlr, int l1, int r1, vector<int> &ldr, int l2, int r2)
{
    int temp;
    if (l2 == r2)
    {
        temp = ldr[l2];
        ldr[l2] = 0;
        return temp;
    }

    int root = l1;
    while (ldr[root] != dlr[l1])
        root++;

    int leftSum = sumTree(dlr, l1 + 1, root, ldr, l2, root - 1);
    int rightSum = sumTree(dlr, root + 1, r1, ldr, root + 1, r2);
    temp = ldr[root];
    ldr[root] = leftSum + rightSum;
    return temp + ldr[root];
}

void sumTree2(vector<int> &inorder, int left, int right)
{
    int mid = (left + right) / 2;
    if (mid == left)
    {
        inorder[mid] = 0;
        return;
    }
    inorder[mid] = accumulate(inorder.begin() + left, inorder.begin() + right, -inorder[mid]);
    sumTree2(inorder, left, mid);
    sumTree2(inorder, mid + 1, right);
}

int main(int argc, char const *argv[])
{
    string line;
    getline(cin, line);
    istringstream dlr_stream(line);
    vector<int> dlr((istream_iterator<int>(dlr_stream)), istream_iterator<int>());
    getline(cin, line);
    istringstream ldr_stream(line);
    vector<int> ldr((istream_iterator<int>(ldr_stream)), istream_iterator<int>());

    sumTree(dlr, 0, dlr.size() - 1, ldr, 0, ldr.size() - 1);
    sumTree2(ldr, 0, ldr.size());

    copy(ldr.begin(), ldr.end(), ostream_iterator<int>(cout, " "));
    cout << endl;
    return 0;
}
