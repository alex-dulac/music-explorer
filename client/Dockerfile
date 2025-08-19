FROM node:16

WORKDIR /app

COPY package*.json ./

RUN npm install

COPY . .

RUN npm run build

RUN npm install -g http-server

EXPOSE 5173

CMD ["http-server", "dist/frontend", "-p", "5173"]
