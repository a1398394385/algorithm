class Solution
{
    public void nextPermutation(int[] nums) {
        int temp = 0;
        boolean flag = false;
        for (int i = nums.length - 1; i > 0; i--) {
            if (nums[i] > nums[i - 1]) {
                flag = true;
            }
        }

        if (flag) {
            int l = -1, r = 0;
            for (int i = 0; i < nums.length - 1; i++) {
                for (int j = i + 1; j <= nums.length - 1; j++) {
                    if (nums[i] < nums[j]) {
                        if (i > l) {
                            l = i;
                            r = j;
                        }
                        if (i == l && nums[j] < temp) {
                            l = i;
                            r = j;
                        }
                        temp = nums[j];
                    }
                }
            }
            temp = nums[l];
            nums[l] = nums[r];
            nums[r] = temp;
            quickSort(nums, l + 1, nums.length - 1);
            return;
        } else {
            for (int l = 0, r = nums.length - 1; l < r; l++, r--) {
                temp = nums[l];
                nums[l] = nums[r];
                nums[r] = temp;
            }
        }
    }

    public void quickSort(int[] array, int left, int right) {
        if (left > right)
            return;
        int l = left, r = right, point = array[l];
        while (l < r) {
            for (; l < r && array[r] >= point; r--);
            if (l < r) array[l++] = array[r];
            for (; l < r && array[l] <= point; l++);
            if (l < r) array[r--] = array[l];
        }
        array[l] = point;
        quickSort(array, left, l - 1);
        quickSort(array, l + 1, right);
    }

    public static void main(String[] args) {
        tempCodeRunnerFile test = new tempCodeRunnerFile();
        test.nextPermutation(new int[] {1, 1, 5});
    }
}
