// 将一个ll类型的数字转换成字符串表示
int ll2string(char *dst, size_t dstlen, long long svalue)
{
	// 从00到99的字符数组
	static const char digits[201] =
		"0001020304050607080910111213141516171819"
		"2021222324252627282930313233343536373839"
		"4041424344454647484950515253545556575859"
		"6061626364656667686970717273747576777879"
		"8081828384858687888990919293949596979899";

	int negative;
	// 之所以将svalue换成value表示，是为了解决当svalue为LLONG_MIN的情况转成正数时溢出问题
	unsigned long long value;

	// 判断是否是负数，若是负数则标记，并转成正数表示
	if (svalue < 0)
	{
		if (svalue != LLONG_MIN)
		{
			value = -svalue;
		}
		else
		{
			value = ((unsigned long long)LLONG_MAX) + 1;
		}
		negative = 1;
	}
	else
	{
		value = svalue;
		negative = 0;
	}

	// 长度检查
	uint32_t const length = digits10(value) + negative;
	if (length >= dstlen)
		return 0;

	uint32_t next = length;
	dst[next] = '\0';
	next--;

	//每次取100的余数，然后参照digits找到对应的字符赋值
	while (value >= 100)
	{
		// 因为都是2位，所以乘以2可以直接找到下标
		int const i = (value % 100) * 2;
		value /= 100;
		// 相邻的两位代表取模后对应的字符
		dst[next] = digits[i + 1];
		dst[next - 1] = digits[i];
		next -= 2;
	}

	// 处理最后剩下的数字
	if (value < 10)
	{
		dst[next] = '0' + (uint32_t)value;
	}
	else
	{
		int i = (uint32_t)value * 2;
		dst[next] = digits[i + 1];
		dst[next - 1] = digits[i];
	}

	// 若为负数，在前头加负号
	if (negative)
		dst[0] = '-';
	return length;
}
