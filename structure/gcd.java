class Gcd
{

    /**
     * 辗转相除法(欧几里得算法) 递归实现
     * 
     * @param x
     * @param y
     * @return
     */
    public int gcd(int x, int y) {
        if (x < y)
            return gcd(y, x);
        return y == 0 ? x : gcd(y, x % y);
    }

    /**
     * 辗转相除法(欧几里得算法) 循环实现
     * 
     * @param x
     * @param y
     * @return
     */
    public int gcd1(int x, int y) {
        if (x < y)
            return gcd(y, x);
        int temp;
        while (y != 0) {
            temp = x % y;
            x = y;
            y = temp;
        }
        return x;
    }

    /**
     * Stein 算法 循环实现
     * 
     * @param x
     * @param y
     * @return
     */
    public int Stein(int x, int y) {
        int c_2 = 0, temp;
        while ((x & 1) != 1 && (y & 1) != 1) {
            x = x >>> 1;
            y = y >>> 1;
            c_2++;
        }
        while ((x & 1) != 1) x = x >>> 1;
        while ((y & 1) != 1) y = y >>> 1;
        if (x < y) {
            temp = x;
            x = y;
            y = temp;
        }
        while (x == ((x - y) >>> 1)) {
            while ((x & 1) != 1) x = x >>> 1;
            if (x < y) {
                temp = x;
                x = y;
                y = temp;
            }
        }
        return y << c_2;
    }

    /**
     * Stein 算法 递归实现
     * 
     * @param x
     * @param y
     * @return
     */
    public int Stein1(int x, int y) {
        if (y > x)
            return Stein1(y, x);
        if (y == 0)
            return x;
        if ((x & 1) != 1) {
            if ((y & 1) != 1)
                return Stein1(x >> 1, y >> 1) << 1;
            else
                return Stein1(x >> 1, y);
        } else {
            if ((y & 1) != 1)
                return Stein1(x, y >> 1);
            else
                return Stein1((x - y) >> 1, y);
        }
    }
}
