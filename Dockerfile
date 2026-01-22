FROM node:18-alpine

# Directorio de trabajo dentro del contenedor
WORKDIR /app

# Copiamos dependencias primero (mejora cache)
COPY package.json yarn.lock ./

# Instalamos dependencias
RUN yarn install --production

# Copiamos el resto del proyecto
COPY . .

# Puerto que expone la app (ajustar si usás otro)
EXPOSE 3000

# Comando de inicio
CMD ["yarn", "start"]
