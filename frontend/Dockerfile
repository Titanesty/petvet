# Используем официальный образ Node.js для сборки Vue.js приложения
# https://v2.vuejs.org/v2/cookbook/dockerize-vuejs-app
FROM node:18-alpine as build-stage

WORKDIR /app

  # Копируем файлы package.json и package-lock.json для установки зависимостей
COPY package*.json ./

  # Устанавливаем зависимости
RUN npm install

  # Копируем оставшиеся файлы проекта и собираем приложение
COPY . .
RUN npm run build

  # Используем официальный образ Nginx для сервировки собранного приложения
FROM nginx:stable-alpine as production-stage
COPY --from=build-stage /app/dist /usr/share/nginx/html

  # Копируем кастомный конфиг nginx (если есть)
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80

CMD ["nginx", "-g", "daemon off;"]
