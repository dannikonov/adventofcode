package main

import (
	"bufio"
	"fmt"
	"os"
	"strconv"
	"strings"
)

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func parseInput(filename string) [][]int {
	f, err := os.Open(filename)
	check(err)
	fileScanner := bufio.NewScanner(f)
	fileScanner.Split(bufio.ScanLines)

	var input [][]int

	for fileScanner.Scan() {
		line := fileScanner.Text()
		numbers := strings.Split(line, " ")

		var tmp []int

		for i := 0; i < len(numbers); i++ {
			x, _ := strconv.Atoi(numbers[i])
			tmp = append(tmp, x)
		}

		input = append(input, tmp)
	}

	f.Close()

	return input
}

func is_safe(set []int) bool {
	var inc, dec int
	for c := 0; c < len(set)-1; c++ {
		if set[c] < set[c+1] {
			df := set[c+1] - set[c]
			if 1 <= df && df <= 3 {
				inc++
			}
		}

		if set[c] > set[c+1] {
			df := set[c] - set[c+1]
			if 1 <= df && df <= 3 {
				dec++
			}
		}
	}

	if inc == len(set)-1 || dec == len(set)-1 {
		return true
	}

	return false
}

func part1(filename string) int {
	input := parseInput(filename)

	var count int
	for r := 0; r < len(input); r++ {
		if is_safe(input[r]) {
			count++
		}
	}

	return count
}

func part2(filename string) int {
	input := parseInput(filename)

	var count int
	for r := 0; r < len(input); r++ {
		success := false
		line := input[r]
		for c := 0; c < len(line); c++ {
			tmp := make([]int, 0, len(line)-1)
			tmp = append(tmp, line[:c]...)
			tmp = append(tmp, line[c+1:]...)

			if is_safe(tmp) {
				success = true
				break
			}
		}

		if success {
			count++
		}

	}

	return count
}

func main() {
	//filename := "../in/example/2.txt"
	filename := "../in/task/2.txt"

	fmt.Println("part 1:")
	fmt.Printf("answer: %d\n", part1(filename)) // 257

	fmt.Println("part 2:")
	fmt.Printf("answer: %d\n", part2(filename)) // 328
}
