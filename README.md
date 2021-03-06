# Broker

The broker provides an easy configurable JSON interface translating JSON into Solr requests with support for caching and query expansion. Support for [Mtas](https://textexploration.github.io/mtas/) is integrated in the Broker. See [textexploration.github.io/broker/](https://textexploration.github.io/broker/) for more documentation and instructions.

A [docker](https://hub.docker.com/r/textexploration/broker/) image is available. To build and run

```console
docker build -t broker https://raw.githubusercontent.com/textexploration/broker/master/docker/Dockerfile
docker run -t -i -p 8080:80 --name broker broker
```

This will provide a website on port 8080 on the ip of your docker host with a running Broker.

---

This project builds upon the latest commit from April 12, 2018 for [meertensinstituut/mtas](https://github.com/meertensinstituut/broker/tree/ff23503afbd9dfe95042774a962a75df7fcbed06). See also the related [mtas](https://github.com/textexploration/broker) project, another continuation of previous work.



