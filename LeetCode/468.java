class Solution
{
    public String validIPAddress(String IP) {
        int check = check(IP);
        if (check == 1 && checkIpv4(IP)) return "IPv4";
        if (check == 2 && checkIPv6(IP)) return "IPv6";
        return "Neither";
    }

    private static int check(String ip) {

        // 判断是否是 IPv6
        if (ip.lastIndexOf(':') != -1) {
            // 不能有点
            if (ip.lastIndexOf('.') != -1) return 0;
            if (ip.length() < 15 || ip.length() > 39) return 0;
            if (ip.lastIndexOf(':') == ip.length() - 1) return 0;
            if (ip.indexOf(':') == 0) return 0;
            return 2;
        }
        if (ip.lastIndexOf('.') != -1) {

            if (ip.lastIndexOf(':') != -1) return 0;
            if (ip.length() < 7 || ip.length() > 15) return 0;
            if (ip.lastIndexOf('.') == ip.length() - 1) return 0;
            if (ip.indexOf('.') == 0) return 0;
            return 1;
        }
        return 0;
    }

    private static boolean checkIPv6(String ip) {

        // 格式符合的 IPv6
        char[] chars = ip.toCharArray();
        int low = 0;
        int points = 0;
        for (int i = 0; i < chars.length; i++) {
            if (!isVaildLetter(chars[i])) return false;
            if (chars[i] != ':') continue;
            ++points;
            if (!isVaild_ip6(chars, low, i - 1)) return false;
            low = i + 1;
        }
        return points == 7 && isVaild_ip6(chars, low, chars.length - 1);
    }

    private static boolean checkIpv4(String ip) {

        // 格式符合条件的 IPv4
        char[] chars = ip.toCharArray();
        int low = 0;
        int points = 0;
        for (int i = 0; i < chars.length; i++) {
            if (!isNumber(chars[i])) return false;
            if (chars[i] != '.') continue;
            ++points;
            if (!isVaild_ip4(chars, low, i - 1)) return false;
            low = i + 1;
        }
        return points == 3 && isVaild_ip4(chars, low, chars.length - 1);

    }

    private static boolean isVaild_ip4(char[] cs, int low, int high) {

        if (high - low > 2) return false;
        if (cs[low] == '.') return false;
        if (high == low) return true;
        if (cs[low] == '0') return false;
        if (high == low + 1) return true;
        // 3
        if (cs[low] == '1') return true;
        if (cs[low] > '2') return false;
        if (cs[low + 1] > '5') return false;
        if (cs[low + 1] < '5') return true;
        if (cs[high] > '5') return false;
        return true;
    }

    private static boolean isNumber(char c) {
        return c >= '0' && c <= '9' || c == '.';
    }

    private static boolean isVaild_ip6(char[] chars, int low, int high) {

        if (high - low > 3) return false;
        if (chars[low] == ':') return false;
        return true;
    }

    private static boolean isVaildLetter(char c) {

        return (c >= '0' && c <= '9') || (c >= 'a' && c <= 'f') || (c >= 'A' && c <= 'F') || c == ':';
    }


    public String validIPAddress1(String IP) {
        if (IP == null) { return "Neither"; }

        String regex0 = "(\\d|[1-9]\\d|1\\d\\d|2[0-4]\\d|25[0-5])";
        String regexIPv4 = regex0 + "(\\." + regex0 + "){3}";
        String regex1 = "([\\da-fA-F]{1,4})";
        String regexIPv6 = regex1 + "(:" + regex1 + "){7}";

        String result = "Neither";
        if (IP.matches(regexIPv4)) {
            result = "IPv4";
        } else if (IP.matches(regexIPv6)) {
            result = "IPv6";
        }
        return result;
    }
}
