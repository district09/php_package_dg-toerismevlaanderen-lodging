<?php

declare(strict_types=1);

namespace DigipolisGent\Toerismevlaanderen\Lodging\Request;

/**
 * Request to get the lodging details.
 */
final class LodgingRequest extends AbstractRequest
{

    /**
     * The query string.
     *
     * @var string
     */
    private $query = <<<EOT
PREFIX sc: <http://purl.org/science/owl/sciencecommons/>
PREFIX rdf: <http://www.w3.org/1999/02/22-rdf-syntax-ns#>
PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>
PREFIX tvl: <https://data.vlaanderen.be/ns/logies#>
PREFIX tva: <https://data.vlaanderen.be/ns/adres#>
PREFIX schema: <http://schema.org/>
PREFIX adms: <http://www.w3.org/ns/adms#>
PREFIX skos: <http://www.w3.org/2004/02/skos/core#>
PREFIX locn: <http://www.w3.org/ns/locn#>
PREFIX foaf: <http://xmlns.com/foaf/0.1/>
PREFIX dcterms: <http://purl.org/dc/terms/>
SELECT
  ?_lodging
  ?id
  ?idIssuer
  ?name
  ?description
  ?numberOfSleepingPlaces
  ?label
  ?street
  ?houseNumber
  ?busNumber
  ?postalCode
  ?locality
  ?email
  ?phoneNumber
  ?contactType
  ?websiteAddress
  ?registrationStatus
  ?starRating
  ?type
WHERE {
  BIND(<%s> AS ?_lodging).
  ?_lodging a tvl:Logies.
  ?_lodging schema:name ?name.
  ?_lodging tvl:aantalSlaapplaatsen ?numberOfSleepingPlaces.
  
  OPTIONAL { ?_lodging tvl:heeftBeschrijving ?_description. }
  ?_description schema:value ?description.
  
  ?_lodging adms:identifier ?_identifier.
  ?_identifier skos:notation ?id.
  ?_identifier adms:schemaAgency ?idIssuer.
  
  ?_lodging tvl:onthaalAdres ?_address.
  ?_address locn:thoroughfare ?street.
  ?_address tva:Adresvoorstelling.huisnummer ?houseNumber.
  OPTIONAL { ?_address tva:Adresvoorstelling.busnummer ?busNumber. }
  ?_address locn:postCode ?postalCode.
  ?_address tva:gemeentenaam ?locality.
   
  OPTIONAL { ?_lodging schema:contactPoint/schema:email ?email. }
  OPTIONAL { ?_lodging schema:contactPoint/schema:telephone ?phoneNumber. }
  OPTIONAL { ?_lodging schema:contactPoint/foaf:page ?websiteAddress. }
  OPTIONAL { ?_lodging schema:contactPoint/schema:contactType ?contactType. }
  
  OPTIONAL { ?_lodging tvl:heeftRegistratie ?_registration. }
  ?_registration dcterms:type ?_type.
  ?_type skos:prefLabel ?type.
  
  ?_registration tvl:registratieStatus ?_concept.
  ?_concept skos:prefLabel ?registrationStatus.
  
  OPTIONAL { ?_lodging tvl:heeftKwaliteitsLabel ?_label. }
  OPTIONAL { ?_lodging schema:starRating ?_starRating. }
  OPTIONAL { ?_starRating schema:ratingValue ?starRating. }
  
  FILTER (LANG(?registrationStatus) = "nl")
  FILTER (LANG(?type) = "nl")
  FILTER (LANG(?description) = "nl")
}
EOT;

    /**
     * Construct a new request.
     *
     * @param string $uri
     *   The lodging URI.
     */
    public function __construct(string $uri)
    {
        $query = sprintf($this->query, $uri);
        parent::__construct($query);
    }
}
