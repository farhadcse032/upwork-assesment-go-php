package handler

import (
	"context"
	"encoding/json"
	"fmt"
	"io"
	"log"
	"net/http"
)

type Post struct {
	UserID int    `json:"userId"`
	ID     int    `json:"id"`
	Title  string `json:"title"`
	Body   string `json:"body"`
}

func HandleRequest(ctx context.Context) error {
	resp, err := http.Get("https://jsonplaceholder.typicode.com/posts")
	if err != nil {
		log.Printf("Error fetching url: %v", err)
		return fmt.Errorf("failed to fetch url")
	}
	defer resp.Body.Close()

	if resp.StatusCode != http.StatusOK {
		log.Printf("Unexpected status code: %d", resp.StatusCode)
		return fmt.Errorf("505 internal server error")
	}

	body, err := io.ReadAll(resp.Body)
	if err != nil {
		log.Printf("Error reading body: %v", err)
		return fmt.Errorf("failed to read response body")
	}

	var posts []Post
	if err := json.Unmarshal(body, &posts); err != nil {
		log.Printf("Error Unmarshal Json: %v", err)
		return fmt.Errorf("invalid Json response")
	}

	if len(posts) > 0 {

		log.Println("Total posts:")
		log.Println("-----------------")
		log.Printf(" %d\n", len(posts))
		log.Println("-----------------")
		log.Printf("\n\n")
		
		log.Println("First post title:")
		log.Println("------------------------------------------")
		log.Printf("%s\n", posts[0].Title)
		log.Println("------------------------------------------")
		return nil
	}

	log.Println("-------------------------------")
	log.Printf("No posts found")
	log.Println("-------------------------------")

	return nil
}
