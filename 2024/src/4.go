package main

import (
	"bufio"
	"fmt"
	"os"
)

func check(e error) {
	if e != nil {
		panic(e)
	}
}

func parseInput(filename string) [][]rune {
	f, err := os.Open(filename)
	check(err)
	fileScanner := bufio.NewScanner(f)
	fileScanner.Split(bufio.ScanLines)

	var input [][]rune
	for fileScanner.Scan() {
		line := []rune(fileScanner.Text())
		input = append(input, line)
	}

	f.Close()

	return input
}

func getRune(matrix [][]rune, r, c int) rune {
	if r < 0 || r > len(matrix)-1 || c < 0 || c > len(matrix[0])-1 {
		return ' '
	}

	return matrix[r][c]
}

func findWord(matrix [][]rune, r int, c int, dr int, dc int) bool {
	return getRune(matrix, r, c) == 'X' &&
		getRune(matrix, r+dr, c+dc) == 'M' &&
		getRune(matrix, r+2*dr, c+2*dc) == 'A' &&
		getRune(matrix, r+3*dr, c+3*dc) == 'S'
}

func findWord2(matrix [][]rune, r int, c int) bool {
	return getRune(matrix, r, c) == 'A' &&
		(getRune(matrix, r-1, c-1) == 'M' && getRune(matrix, r+1, c+1) == 'S' && getRune(matrix, r-1, c+1) == 'M' && getRune(matrix, r+1, c-1) == 'S' ||
			getRune(matrix, r-1, c+1) == 'M' && getRune(matrix, r+1, c-1) == 'S' && getRune(matrix, r+1, c+1) == 'M' && getRune(matrix, r-1, c-1) == 'S' ||
			getRune(matrix, r+1, c+1) == 'M' && getRune(matrix, r-1, c-1) == 'S' && getRune(matrix, r+1, c-1) == 'M' && getRune(matrix, r-1, c+1) == 'S' ||
			getRune(matrix, r+1, c-1) == 'M' && getRune(matrix, r-1, c+1) == 'S' && getRune(matrix, r-1, c-1) == 'M' && getRune(matrix, r+1, c+1) == 'S')
}

func part1(filename string) int {
	input := parseInput(filename)

	count := 0
	directions := [][]int{
		{0, 1}, {1, 1}, {1, 0}, {1, -1}, {0, -1}, {-1, -1}, {-1, 0}, {-1, 1},
	}

	for r, row := range input {
		for c, _ := range row {
			for _, direction := range directions {
				if findWord(input, r, c, direction[0], direction[1]) {
					count++
				}
			}
		}
	}

	return count
}

func part2(filename string) int {
	input := parseInput(filename)

	count := 0
	for r, row := range input {
		for c, _ := range row {

			if findWord2(input, r, c) {
				count++
			}

		}
	}

	return count
}

func main() {
	//filename := "../in/example/4.txt"
	filename := "../in/task/4.txt"

	fmt.Println("part 1:")
	fmt.Printf("answer: %d\n", part1(filename)) // 2447

	fmt.Println("part 2:")
	fmt.Printf("answer: %d\n", part2(filename)) // 1868
}
