FROM node:17.7.1

RUN mkdir -p /app/src

WORKDIR /usr/app

COPY package*.json ./

RUN npm update

COPY . .

EXPOSE 3000

CMD ["npm", "start"]