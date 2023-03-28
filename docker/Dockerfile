# use node 18 version
ARG NODE_VERSION="gallium-alpine"
FROM node:${NODE_VERSION} AS runner

RUN apk --no-cache add curl
WORKDIR /app
ENV NODE_ENV production
# define uid and gid to run node, can be customized by --build-arg or build: args:
ARG uid=1000
ARG gid=1000
RUN grep ":${gid}:" /etc/group || addgroup -g ${gid} frontend
RUN grep ":${uid}:" /etc/passwd || adduser -u ${uid} frontend -G $(getent group ${gid} | cut -d: -f1)
COPY ./package*.json /app/
# RUN yarn install
RUN npm install && npm cache clean --force
# RUN pnpm install --shamefully-hoist
# You only need to copy next.config.js if you are NOT using the default configuration
COPY ./. ./
USER ${uid}:${gid}
EXPOSE 3000
ENV PATH ./node_modules/.bin/:$PATH
CMD ["npm", "run", "build"]