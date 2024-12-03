package main

import (
	"bufio"
	"fmt"
	"os"
	"regexp"
	"strconv"
)

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func parseInput(filename string) []string {
	f, err := os.Open(filename)
	check(err)
	fileScanner := bufio.NewScanner(f)
	fileScanner.Split(bufio.ScanLines)

	var input []string
	for fileScanner.Scan() {
		line := fileScanner.Text()
		input = append(input, line)
	}

	f.Close()

	return input
}

func part1(filename string) int {
	input := parseInput(filename)

	r, _ := regexp.Compile(`mul\(([0-9]{1,3}),([0-9]{1,3})\)`)

	result := 0
	for i := 0; i < len(input); i++ {
		for _, match := range r.FindAllStringSubmatch(input[i], -1) {
			a, _ := strconv.Atoi(match[1])
			b, _ := strconv.Atoi(match[2])
			result += a * b
		}
	}

	return result
}

func part2(filename string) int {
	input := parseInput(filename)

	r, _ := regexp.Compile(`do\(\)|don't\(\)|mul\(([0-9]{1,3}),([0-9]{1,3})\)`)

	result := 0
	instruction := "do()"
	for i := 0; i < len(input); i++ {
		for _, match := range r.FindAllStringSubmatch(input[i], -1) {
			if match[0] == "do()" || match[0] == "don't()" {
				instruction = match[0]
			}

			if instruction == "do()" {
				a, _ := strconv.Atoi(match[1])
				b, _ := strconv.Atoi(match[2])
				result += a * b
			}
		}
	}

	return result
}

func main() {
	//filename := "../in/example/3.txt"
	//filename := "../in/example/3_2.txt"
	filename := "../in/task/3.txt"

	fmt.Println("part 1:")
	fmt.Printf("answer: %d\n", part1(filename)) // 187194524

	fmt.Println("part 2:")
	fmt.Printf("answer: %d\n", part2(filename)) // 127092535
}
