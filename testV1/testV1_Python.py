def is_prime(num):
    if num <= 1:
        return False
    if num <= 3:
        return True
    if num % 2 == 0 or num % 3 == 0:
        return False
    i = 5
    while i * i <= num:
        if num % i == 0 or num % (i + 2) == 0:
            return False
        i += 6
    return True

numbers = list(range(1, 101))
numbers.reverse()

result = []
for num in numbers:
    if is_prime(num):
        continue
    if num % 3 == 0 and num % 5 == 0:
        result.append("FooBar")
    elif num % 3 == 0:
        result.append("Foo")
    elif num % 5 == 0:
        result.append("Bar")
    else:
        result.append(num)

print(", ".join(map(str, result)))
