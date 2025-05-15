package main

import (
	"context"
	"log"
	"upwork-assesment-go-php/go-lambda-task/handler"
	// "github.com/aws/aws-lambda-go/lambda"
)

func main() {
	// lambda.Start(handler.HandleRequest)

	err := handler.HandleRequest(context.Background())
	if err != nil {
		log.Fatalf("Error: %v", err)
	}
}
