# Use an official Node.js runtime as the base image for development
FROM node:latest as development

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY ./package*.json ./

# Install Node.js dependencies for development
RUN npm install

# Copy the Next.js app source code to the working directory
COPY . ./

# Expose port 3000 for development
EXPOSE 3000

# Start the Next.js development server
CMD ["npm", "run", "dev"]

# Use a separate build stage for production
FROM node:latest as production

# Set the working directory in the container
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY ./package*.json ./

# Install Node.js dependencies for production
RUN npm install --only=production

# Copy the Next.js app source code to the working directory
COPY . ./

# Build the Next.js app for production
RUN npm run build

# Use an official Nginx runtime as the base image for serving production
FROM nginx:alpine as serve-production

# Copy the built Next.js app from the production build stage
COPY --from=production /app/.next /usr/share/nginx/html

# Expose port 80 for production
EXPOSE 80

# Start Nginx to serve the production build
CMD ["nginx", "-g", "daemon off;"]
