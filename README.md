## Urly

### Commandline URL Shortener and Expander

Urly shortens URLs using the [bit.ly][1] api and expands any short URL
into it's longform using the [longform.org][2] api.

It was written to illustrate [Dependency Injection in Encase][3].

## Usage

To shorten any URL use the `--shorten` option or it's shorter version `-s`.

```bash
$ bin/urly --shorten http://long-url-here.com
```

And to expand a shortened url use the `--expand` option or it's shorter
version `-e`.

```bash
$ bin/urly --expand http://short.url
```

## Requirements

You'll need to create 2 Environment Variables before you can use `urly`.

1. BITLY_API_KEY - Your bitly api key.
2. BITLY_LOGIN - Your bitly login name.

You can do this on the commandline using the shell built-in `export`.

```
export BITLY_API_KEY=your_key
export BITLY_LOGIN=your_login
```

## License

MIT License. Copyright © 2014 Darshan Sawardekar

[1]: http://dev.bitly.com
[2]: http://longform.org/api
[3]: http://pressing-matters.io/encase-a-lightweight-ioc-container-for-php/
