import java.util.HashMap;
import java.util.Random;

/**
 * The rand7() API is already defined in the parent class SolBase. <br/>
 * public int rand7();
 * 
 * @return a random integer in the range 1 to 7
 */
class Solution extends SolBase
{
    // 拒绝采样
    // 把rand7()想象成一个7面的骰子🎲，现在我们有两个骰子
    // 第一次如果掷出1,2,3,4,5,6就掷下一个骰子；如果掷出7，就继续掷这个骰子，直到不是7为止
    // 第二次如果掷出1,2,3,4,5就结束；如果掷出6,7，就继续掷这个骰子，直到不是6,7为止
    // 如果第一次掷出1,3,5，则first记为0；如果第一次掷出2,4,6，则记first为5；记第二次掷出的为second
    // 最后返回first+second

    public int rand10() {
        int a = rand7(), b = rand7();
        while (a == 7) a = rand7();
        while (b > 5) b = rand7();

        if (a % 2 == 1)
            return b;
        else
            return b + 5;
    }

    /**
     * 已知 rand_N() 可以等概率的生成[1, N]范围的随机数
     * 
     * 可得 (rand_X() - 1) * Y + rand_Y() ==> 可以等概率的生成[1, X * Y]范围的随机数
     */
    public int rand10() {
        while (true) {
            int num = (rand7() - 1) * 7 + rand7(); // 等概率生成[1,49]范围的随机数
            if (num <= 40) return num % 10 + 1; // 拒绝采样，并返回[1,10]范围的随机数
        }
    }

    public int rand10() {
        while (true) {
            int a = rand7();
            int b = rand7();
            int num = (a - 1) * 7 + b; // rand 49
            if (num <= 40) return num % 10 + 1; // 拒绝采样

            a = num - 40; // rand 9
            b = rand7();
            num = (a - 1) * 7 + b; // rand 63
            if (num <= 60) return num % 10 + 1;

            a = num - 60; // rand 3
            b = rand7();
            num = (a - 1) * 7 + b; // rand 21
            if (num <= 20) return num % 10 + 1;
        }
    }



    public int rand7() {
        Random random = new Random();
        return random.nextInt(7) + 1;
    }
}
