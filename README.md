# bbc-wildlife

## Background
The BBC created a lightweight ontology (available from http://purl.org/ontology/wo/ ) for publishing data about all forms of biological taxa, including phyla, families, and species. The terms in this ontology allow data to be published about:

- The relationships between taxa
- Their associations with specific habitats, their mode of life, as well as their specific behaviours
- Whether a taxon is endangered according to the IUCN terms
- Topic relations between web documents and multimedia objects that may feature a taxon...etc.

![Ontology](https://github.com/rdmpage/bbc-wildlife/raw/master/ontology/p01rpm09.png)

The Wildlife Ontology was originally designed to support the publishing of data from the [BBC Wildlife Finder application](http://www.bbc.co.uk/nature/life/) which provided access to a rich set of information and data about biological species, as well as pointers to BBC broadcast output that relate to these topics.

## Repository

This repository has a copy of the ontology, and also the RDF for each page in the BBC Wildlife Finder site. It is designed to (a) ensure that if the BBC Wildlife Finder site disappears the core data is still available (the site currently has a message saying it was last updated October 2014), and (b) to provide the data as a test bed for exploring linked data on organisms. The BBC Wildlife Finder enables visitors to view information on individual taxonomic groups, and also group taxa by habitats, places, ecotones, or adaptations.

## Problems

The RDF has some issues. We need to add

```
 xml:base="http://www.bbc.co.uk"
```

to the <rdf:RDF> tag so that URLs for BBC items are absolute URLs. Also need to handle <a href=“”> tags in <dc:description> (for example by enclosing in <![CDATA[ … ]]> ).


## Queries

List habitats for a taxon:

```
SELECT ?label
WHERE
{
 ?taxon <http://purl.org/ontology/wo/livesIn> ?habitat .
 ?habitat <http://www.w3.org/2000/01/rdf-schema#label> ?label .
}
```
