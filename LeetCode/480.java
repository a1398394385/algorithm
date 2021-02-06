class Solution
{
    class Node
    {
        public int count;
        public Node prev;
        public Node next;

        public Node(int count) {
            this.count = count;
        }

        public Node(int count, Node prev, Node next) {
            this.count = count;
            this.prev = prev;
            this.next = next;
        }

        public void change(int num) {
            if (num == count) return;
            if (num > count) getBig(num);
            if (num < count) getSmall(num);
        }

        private void getBig(int num) {
            count = num;
            while (count > prev.count) {
                Node temp = this.prev;
                this.prev = temp.prev;
                temp.prev.next = this;
                temp.next = this.next;
                this.next.prev = temp;
                this.next = temp;
                temp.prev = this;
            }
        }

        private void getSmall(int num) {
            count = num;
            while (count < next.count) {
                Node temp = this.next;
                this.next = temp.next;
                temp.next.prev = this;
                temp.prev = this.prev;
                this.prev.next = temp;
                this.prev = temp;
                temp.next = this;
            }
        }
    }

    public double[] medianSlidingWindow(int[] nums, int k) {
        Node[] window = new Node[k + 1];
        window[0] = new Node(Integer.MAX_VALUE);
        for (int i = 1; i < window.length; i++) {
            window[i] = new Node(0, window[i - 1], null);
            window[i - 1].next = window[i];
        }
        window[k].next = new Node(Integer.MIN_VALUE, window[k], null);
        for (int i = 0; i < k; i++) {
            window[i + 1].change(nums[i]);
        }
        double[] result = new double[nums.length - k + 1];
        int point = k, index = 0;
        for (int right = k - 1; right < nums.length; right++) {
            if (point == k + 1) point = 1;
            window[point++].change(nums[right]);
            result[index++] = getMedian(window[0], k);
        }
        return result;
    }

    public double getMedian(Node first, int length) {
        if ((length & 1) == 1) {
            for (int i = 0; i < Math.ceil((double) length / 2); i++) first = first.next;
            return first.count;
        }
        for (int i = 0; i < length >> 1; i++) first = first.next;
        return ((double) first.count + (double) first.next.count) / 2;
    }
}
