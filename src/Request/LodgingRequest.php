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
PREFIX geoc: <http://www.w3.org/2003/01/geo/wgs84_pos#>
PREFIX geo: <http://www.opengis.net/ont/geosparql#>
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
  ?name
  ?description
  ?numberOfSleepingPlaces
  ?registration_type
  ?registration_status
  ?receptionAddress_street
  ?receptionAddress_houseNumber
  ?receptionAddress_busNumber
  ?receptionAddress_postalCode
  ?receptionAddress_locality
  ?receptionAddress_longitude
  ?receptionAddress_latitude
  (GROUP_CONCAT(DISTINCT ?contactPoint_phoneNumber; SEPARATOR=",") AS ?phoneNumbers)
  (GROUP_CONCAT(DISTINCT ?contactPoint_emailAddress; SEPARATOR=",") AS ?emailAdresses)
  (GROUP_CONCAT(DISTINCT ?contactPoint_websiteAddress; SEPARATOR=",") AS ?websiteAddresses)
  ?starRating
  (GROUP_CONCAT(DISTINCT ?qualityLabel; SEPARATOR=",") AS ?qualityLabels)
  (GROUP_CONCAT(DISTINCT ?media; SEPARATOR=",") AS ?images)

WHERE {
  BIND(<%s> AS ?_lodging).
  ?_lodging a tvl:Logies.
  ?_lodging schema:name ?name.
  ?_lodging tvl:aantalSlaapplaatsen ?numberOfSleepingPlaces.
  
  OPTIONAL { ?_lodging tvl:heeftBeschrijving/schema:value ?description. }
  
  ?_lodging tvl:onthaalAdres ?_receptionAddress.
  ?_receptionAddress locn:thoroughfare ?receptionAddress_street.
  ?_receptionAddress tva:Adresvoorstelling.huisnummer ?receptionAddress_houseNumber.
  OPTIONAL { ?_receptionAddress tva:Adresvoorstelling.busnummer ?receptionAddress_busNumber. }
  ?_receptionAddress locn:postCode ?receptionAddress_postalCode.
  ?_receptionAddress tva:gemeentenaam ?receptionAddress_locality.
  
  OPTIONAL { ?_lodging tvl:onthaalLocatie ?_receptionAddress_location.
             ?_receptionAddress_location geoc:long ?receptionAddress_longitude.
             ?_receptionAddress_location geoc:lat ?receptionAddress_latitude.
  }
  
  OPTIONAL { ?_lodging schema:contactPoint/schema:telephone ?contactPoint_phoneNumber. }
  OPTIONAL { ?_lodging schema:contactPoint/schema:email ?contactPoint_emailAddress. }
  OPTIONAL { ?_lodging schema:contactPoint/foaf:page ?contactPoint_websiteAddress. }
  
  OPTIONAL { ?_lodging tvl:heeftRegistratie ?_registration. 
             ?_registration dcterms:type ?_registration_type.
             ?_registration_type skos:prefLabel ?registration_type.
             ?_registration tvl:registratieStatus ?_registration_status.
             ?_registration_status skos:prefLabel ?registration_status.
  }
  
  OPTIONAL { ?_lodging schema:starRating/schema:ratingValue ?starRating. }
  OPTIONAL { ?_lodging tvl:heeftKwaliteitslabel/skos:prefLabel ?qualityLabel. }
  
  OPTIONAL { ?_lodging tvl:heeftMedia/schema:contentUrl ?media. }
  
  FILTER (LANG(?registration_status) = "nl")
  FILTER (LANG(?registration_type) = "nl")
  FILTER (LANG(?description) = "nl")
  FILTER (LANG(?qualityLabel) = "nl")
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
