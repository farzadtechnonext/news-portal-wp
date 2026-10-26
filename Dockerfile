FROM wordpress:latest

# WP-CLI, copied from the official image so the container can run `wp ...`
COPY --from=wordpress:cli /usr/local/bin/wp /usr/local/bin/wp

# Entrypoint wrapper that fixes wp-content permissions on every start.
# The sed line strips Windows (CRLF) line endings so the script always runs.
COPY entrypoint.sh /usr/local/bin/wp-dev-entrypoint.sh
RUN sed -i 's/\r$//' /usr/local/bin/wp-dev-entrypoint.sh \
 && chmod +x /usr/local/bin/wp-dev-entrypoint.sh

ENTRYPOINT ["wp-dev-entrypoint.sh"]
CMD ["apache2-foreground"]
