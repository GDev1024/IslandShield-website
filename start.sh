#!/bin/bash

echo "🚀 IslandShield Security - Docker Setup"
echo "========================================"

# Check if Docker is installed
if ! command -v docker &> /dev/null; then
    echo "❌ Docker is not installed. Please install Docker first."
    exit 1
fi

# Check if docker-compose is installed
if ! command -v docker-compose &> /dev/null; then
    echo "❌ Docker Compose is not installed. Please install Docker Compose first."
    exit 1
fi

# Create .env file if it doesn't exist
if [ ! -f .env ]; then
    echo "📝 Creating .env file from .env.example..."
    cp .env.example .env
    echo "⚠️  Please update .env with your actual credentials!"
fi

# Build and start containers
echo "🔨 Building Docker containers..."
docker-compose build

echo "🚀 Starting containers..."
docker-compose up -d

# Wait for database to be ready
echo "⏳ Waiting for database to be ready..."
sleep 10

# Import database schema
echo "📊 Importing database schema..."
docker-compose exec -T db mysql -uislandshield_user -psecure_password islandshield_db < includes/islandshield_database.sql

echo ""
echo "✅ Setup complete!"
echo ""
echo "🌐 Access your application:"
echo "   - Website: http://localhost:8080"
echo "   - phpMyAdmin: http://localhost:8081"
echo ""
echo "📝 Default database credentials:"
echo "   - User: islandshield_user"
echo "   - Password: secure_password"
echo ""
echo "🛑 To stop: docker-compose down"
echo "📋 View logs: docker-compose logs -f"
