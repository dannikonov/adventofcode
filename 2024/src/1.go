package main

import (
	"bufio"
	"fmt"
	"os"
	"sort"
)

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func distance(x, y int) int {
	if x < y {
		return y - x
	}
	return x - y
}

func part1(filename string) int {
	var left, right []int

	f, err := os.Open(filename)
	check(err)
	fileScanner := bufio.NewScanner(f)
	fileScanner.Split(bufio.ScanLines)

	for fileScanner.Scan() {
		line := fileScanner.Text()

		var l, r int
		fmt.Sscanf(line, "%d %d", &l, &r)
		left = append(left, l)
		right = append(right, r)
	}

	sort.Ints(left)
	sort.Ints(right)

	f.Close()

	result := 0
	for i := 0; i < len(left); i++ {
		result += distance(left[i], right[i])
	}
	return result
}

func part2(filename string) int {
	var left []int
	right := make(map[int]int)

	f, err := os.Open(filename)
	check(err)
	fileScanner := bufio.NewScanner(f)
	fileScanner.Split(bufio.ScanLines)

	for fileScanner.Scan() {
		line := fileScanner.Text()

		var l, r int
		fmt.Sscanf(line, "%d %d", &l, &r)
		left = append(left, l)
		right[r]++
	}

	f.Close()

	result := 0
	for i := 0; i < len(left); i++ {
		result += left[i] * right[left[i]]
	}

	return result
}

func main() {
	//filename := "../in/example/1.txt"
	filename := "../in/task/1.txt"

	fmt.Println("part 1:")
	fmt.Printf("answer: %d\n", part1(filename))

	fmt.Println("part 2:")
	fmt.Printf("answer: %d\n", part2(filename))
}
