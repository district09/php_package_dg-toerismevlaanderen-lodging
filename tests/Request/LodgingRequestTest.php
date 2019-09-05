<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Toerismevlaanderen\Lodging\Request;

use DigipolisGent\Toerismevlaanderen\Lodging\Request\LodgingRequest;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Toerismevlaanderen\Lodging\Request\LodgingRequest
 */
class LodgingRequestTest extends TestCase
{
    /**
     * The constructor creates the proper URI.
     *
     * @test
     */
    public function uriContainsQuery(): void
    {
        $request = new LodgingRequest('https://domain.be/7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999');
        $expected = 'query=PREFIX+geoc%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2003%2F01%2Fgeo%2Fwgs84_pos%23%3E+PREFIX+geo%3A+%3Chttp%3A%2F%2Fwww.opengis.net%2Font%2Fgeosparql%23%3E+PREFIX+sc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fscience%2Fowl%2Fsciencecommons%2F%3E+PREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E+PREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E+PREFIX+tvl%3A+%3Chttps%3A%2F%2Fdata.vlaanderen.be%2Fns%2Flogies%23%3E+PREFIX+tva%3A+%3Chttps%3A%2F%2Fdata.vlaanderen.be%2Fns%2Fadres%23%3E+PREFIX+schema%3A+%3Chttp%3A%2F%2Fschema.org%2F%3E+PREFIX+adms%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fadms%23%3E+PREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E+PREFIX+locn%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Flocn%23%3E+PREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E+PREFIX+dcterms%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E+SELECT+%3F_lodging+%3Fname+%3Fdescription+%3FnumberOfSleepingPlaces+%3Fregistration_type+%3Fregistration_status+%3FreceptionAddress_street+%3FreceptionAddress_houseNumber+%3FreceptionAddress_busNumber+%3FreceptionAddress_postalCode+%3FreceptionAddress_locality+%3FreceptionAddress_longitude+%3FreceptionAddress_latitude+%28GROUP_CONCAT%28DISTINCT+%3FcontactPoint_phoneNumber%3B+SEPARATOR%3D%22%2C%22%29+AS+%3FcontactPoint_phoneNumbers%29+%28GROUP_CONCAT%28DISTINCT+%3FcontactPoint_emailAddress%3B+SEPARATOR%3D%22%2C%22%29+AS+%3FcontactPoint_emailAddresses%29+%28GROUP_CONCAT%28DISTINCT+%3FcontactPoint_websiteAddress%3B+SEPARATOR%3D%22%2C%22%29+AS+%3FcontactPoint_websiteAddresses%29+%3Frating+%28GROUP_CONCAT%28DISTINCT+%3FqualityLabel%3B+SEPARATOR%3D%22%2C%22%29+AS+%3FqualityLabels%29+%28GROUP_CONCAT%28DISTINCT+%3Fmedia%3B+SEPARATOR%3D%22%2C%22%29+AS+%3Fimages%29+WHERE+%7B+BIND%28%3Chttps%3A%2F%2Fdomain.be%2F7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999%3E+AS+%3F_lodging%29.+%3F_lodging+a+tvl%3ALogies.+%3F_lodging+schema%3Aname+%3Fname.+%3F_lodging+tvl%3AaantalSlaapplaatsen+%3FnumberOfSleepingPlaces.+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftBeschrijving%2Fschema%3Avalue+%3Fdescription.+%7D+%3F_lodging+tvl%3AonthaalAdres+%3F_receptionAddress.+%3F_receptionAddress+locn%3Athoroughfare+%3FreceptionAddress_street.+%3F_receptionAddress+tva%3AAdresvoorstelling.huisnummer+%3FreceptionAddress_houseNumber.+OPTIONAL+%7B+%3F_receptionAddress+tva%3AAdresvoorstelling.busnummer+%3FreceptionAddress_busNumber.+%7D+%3F_receptionAddress+locn%3ApostCode+%3FreceptionAddress_postalCode.+%3F_receptionAddress+tva%3Agemeentenaam+%3FreceptionAddress_locality.+OPTIONAL+%7B+%3F_lodging+tvl%3AonthaalLocatie+%3F_receptionAddress_location.+%3F_receptionAddress_location+geoc%3Along+%3FreceptionAddress_longitude.+%3F_receptionAddress_location+geoc%3Alat+%3FreceptionAddress_latitude.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Fschema%3Atelephone+%3FcontactPoint_phoneNumber.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Fschema%3Aemail+%3FcontactPoint_emailAddress.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Ffoaf%3Apage+%3FcontactPoint_websiteAddress.+%7D+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftRegistratie+%3F_registration.+%3F_registration+dcterms%3Atype+%3F_registration_type.+%3F_registration_type+skos%3AprefLabel+%3Fregistration_type.+%3F_registration+tvl%3AregistratieStatus+%3F_registration_status.+%3F_registration_status+skos%3AprefLabel+%3Fregistration_status.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AstarRating%2Fschema%3AratingValue+%3Frating.+%7D+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftKwaliteitslabel%2Fskos%3AprefLabel+%3FqualityLabel.+%7D+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftMedia%2Fschema%3AcontentUrl+%3Fmedia.+%7D+FILTER+%28LANG%28%3Fregistration_status%29+%3D+%22nl%22%29+FILTER+%28LANG%28%3Fregistration_type%29+%3D+%22nl%22%29+FILTER+%28LANG%28%3Fdescription%29+%3D+%22nl%22%29+FILTER+%28LANG%28%3FqualityLabel%29+%3D+%22nl%22%29+%7D';
        $this->assertSame($expected, (string) $request->getBody());
    }
}
