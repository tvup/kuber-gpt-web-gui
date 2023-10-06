FROM ubuntu:22.04

LABEL maintainer="T. E. H."

ARG WWWGROUP
ARG NODE_VERSION=14

WORKDIR /var/www/html

ENV DEBIAN_FRONTEND noninteractive
ENV TZ=UTC

RUN ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone

RUN apt-get update
RUN apt-get install -y locales apt-utils
RUN sed -i -e 's/# en_US.UTF-8 UTF-8/en_US.UTF-8 UTF-8/' /etc/locale.gen && \
    dpkg-reconfigure locales && \
    update-locale LANG=en_US.UTF-8
ENV LANG en_US.UTF-8
RUN apt-get install -y gnupg gosu curl ca-certificates zip unzip git supervisor libcap2-bin libpng-dev python2 dnsutils \
    && curl -sS 'https://keyserver.ubuntu.com/pks/lookup?op=get&search=0x14aa40ec0831756756d7f66c4f4ea0aae5267a6c' | gpg --dearmor | tee /etc/apt/keyrings/ppa_ondrej_php.gpg > /dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/ppa_ondrej_php.gpg] https://ppa.launchpadcontent.net/ondrej/php/ubuntu jammy main" > /etc/apt/sources.list.d/ppa_ondrej_php.list \
    && apt-get update \
    && apt-get install -y php8.2-cli php8.2-dev \
       php8.2-pgsql php8.2-gd php8.2-imagick \
       php8.2-curl \
       php8.2-imap php8.2-mysql php8.2-mbstring \
       php8.2-xml php8.2-zip php8.2-bcmath php8.2-soap \
       php8.2-intl php8.2-readline \
       php8.2-ldap \
       php8.2-msgpack php8.2-igbinary php8.2-redis php8.2-swoole \
       php8.2-memcached php8.2-pcov php8.2-xdebug \
       php8.2-sqlite3 \
    && curl -sLS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer \
    && curl -sLS https://deb.nodesource.com/setup_$NODE_VERSION.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g npm \
    && curl -sS https://dl.yarnpkg.com/debian/pubkey.gpg | gpg --dearmor | tee /etc/apt/keyrings/yarn.gpg >/dev/null \
    && echo "deb [signed-by=/etc/apt/keyrings/yarn.gpg] https://dl.yarnpkg.com/debian/ stable main" > /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y yarn \
    && apt-get install -y mysql-client \
    && apt-get install -y redis-tools

RUN apt-get install -y ssmtp \
    && apt-get install -y mailutils \
    && apt-get -y autoremove \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*


RUN  \
    curl -fsSL https://swupdate.openvpn.net/repos/repo-public.gpg | gpg --dearmor > /etc/apt/trusted.gpg.d/openvpn-repo-public.gpg \
    && echo "deb [arch=amd64 signed-by=/etc/apt/trusted.gpg.d/openvpn-repo-public.gpg] https://build.openvpn.net/debian/openvpn/stable jammy main" > /etc/apt/sources.list.d/openvpn-aptrepo.list \
    && apt-get update && apt-get install openvpn -y

RUN cd /opt \
    && curl -L https://github.com/OpenVPN/easy-rsa/releases/download/v3.1.2/EasyRSA-3.1.2.tgz --output EasyRSA.tgz \
    && tar zxvf EasyRSA.tgz \
    && rm -rf /etc/openvpn/easy-rsa \
    && mkdir /etc/openvpn/easy-rsa

RUN  cd /etc/openvpn/easy-rsa \
    && /opt/EasyRSA-3.1.2/easyrsa init-pki \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa build-ca nopass


RUN cd /etc/openvpn/easy-rsa \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa gen-req openvpn nopass \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req server openvpn

RUN cd /etc/openvpn/easy-rsa \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa gen-req client1  nopass\
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req client client1
RUN cd /etc/openvpn/easy-rsa \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa gen-req client2  nopass\
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req client client2
RUN cd /etc/openvpn/easy-rsa \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa gen-req client3  nopass\
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req client client3
RUN cd /etc/openvpn/easy-rsa \
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa gen-req client4  nopass\
    && EASYRSA_BATCH=1 /opt/EasyRSA-3.1.2/easyrsa sign-req client client4

RUN cd /etc/openvpn/easy-rsa \
    && /opt/EasyRSA-3.1.2/easyrsa gen-dh

RUN cd /etc/openvpn/easy-rsa \
    && openvpn --genkey tls-auth ta.key


RUN cd /etc/openvpn/easy-rsa/pki/ \
    && git clone https://github.com/tvup/openvpn-web-gui.git \
    && cd openvpn-web-gui \
    && git checkout origin/feature/tvup-magic \
    && composer install \
    && php -r "copy('.env.example', '.env');"


#RUN chmod 777 /etc/openvpn/easy-rsa/pki
#RUN chmod -R 755 /etc/openvpn/easy-rsa/pki/*
#RUN chmod +x /etc/openvpn/easy-rsa/pki/script-revoke-web.sh
#RUN chmod +x /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web_FULLTCP.sh
#RUN chmod +x /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web_TS.sh

#RUN echo "sail ALL = (ALL) NOPASSWD: /etc/openvpn/easy-rsa/pki/script-revoke-web.sh, /etc/openvpn/easy-rsa/pki/revoke-full, /etc/openvpn/easy-rsa/pki/pkitool, /usr/bin/mailx, /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web.sh, /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web_FULLTCP.sh, /etc/openvpn/easy-rsa/pki/build-key-pass-batch-web_TS.sh" >> /etc/sudoers

COPY ./server.conf /etc/openvpn/


RUN setcap "cap_net_bind_service=+ep" /usr/bin/php8.2

RUN groupadd --force -g $WWWGROUP sail
RUN useradd -ms /bin/bash --no-user-group -g $WWWGROUP -u 1337 sail

COPY start-container /usr/local/bin/start-container
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf
COPY php.ini /etc/php/8.2/cli/conf.d/99-sail.ini
COPY ssmtp.conf /etc/ssmtp/
COPY revaliases /etc/ssmtp/
RUN chmod +x /usr/local/bin/start-container

EXPOSE 8000

ENTRYPOINT ["start-container"]
