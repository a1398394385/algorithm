import java.util.HashSet;
import java.util.TreeMap;

class ParkingSystem
{
    private int[] space = new int[4];

    public ParkingSystem(int big, int medium, int small) {
        this.space[1] = big;
        this.space[2] = medium;
        this.space[3] = small;
    }

    public boolean addCar(int carType) {
        if (space[carType] == 0) return false;
        space[carType]--;
        return true;
        HashSet<String> hashSet = new HashSet<>();
        hashSet.add("sete");
    }
}
