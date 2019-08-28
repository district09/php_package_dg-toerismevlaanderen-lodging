<?php

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
        $expected = 'query=PREFIX+sc%3A+%3Chttp%3A%2F%2Fpurl.org%2Fscience%2Fowl%2Fsciencecommons%2F%3E+PREFIX+rdf%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F1999%2F02%2F22-rdf-syntax-ns%23%3E+PREFIX+rdfs%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2000%2F01%2Frdf-schema%23%3E+PREFIX+tvl%3A+%3Chttps%3A%2F%2Fdata.vlaanderen.be%2Fns%2Flogies%23%3E+PREFIX+tva%3A+%3Chttps%3A%2F%2Fdata.vlaanderen.be%2Fns%2Fadres%23%3E+PREFIX+schema%3A+%3Chttp%3A%2F%2Fschema.org%2F%3E+PREFIX+adms%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Fadms%23%3E+PREFIX+skos%3A+%3Chttp%3A%2F%2Fwww.w3.org%2F2004%2F02%2Fskos%2Fcore%23%3E+PREFIX+locn%3A+%3Chttp%3A%2F%2Fwww.w3.org%2Fns%2Flocn%23%3E+PREFIX+foaf%3A+%3Chttp%3A%2F%2Fxmlns.com%2Ffoaf%2F0.1%2F%3E+PREFIX+dcterms%3A+%3Chttp%3A%2F%2Fpurl.org%2Fdc%2Fterms%2F%3E+SELECT+%3F_lodging+%3Fid+%3FidIssuer+%3Fname+%3Fdescription+%3FnumberOfSleepingPlaces+%3Flabel+%3Fstreet+%3FhouseNumber+%3FbusNumber+%3FpostalCode+%3Flocality+%3Femail+%3FphoneNumber+%3FcontactType+%3FwebsiteAddress+%3FregistrationStatus+%3FstarRating+%3Ftype+WHERE+%7B+BIND%28%3Chttps%3A%2F%2Fdomain.be%2F7e9bf017-aec6-4b27-a21b-0c33cae0ae2e-999999%3E+AS+%3F_lodging%29.+%3F_lodging+a+tvl%3ALogies.+%3F_lodging+schema%3Aname+%3Fname.+%3F_lodging+tvl%3AaantalSlaapplaatsen+%3FnumberOfSleepingPlaces.+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftBeschrijving+%3F_description.+%7D+%3F_description+schema%3Avalue+%3Fdescription.+%3F_lodging+adms%3Aidentifier+%3F_identifier.+%3F_identifier+skos%3Anotation+%3Fid.+%3F_identifier+adms%3AschemaAgency+%3FidIssuer.+%3F_lodging+tvl%3AonthaalAdres+%3F_address.+%3F_address+locn%3Athoroughfare+%3Fstreet.+%3F_address+tva%3AAdresvoorstelling.huisnummer+%3FhouseNumber.+OPTIONAL+%7B+%3F_address+tva%3AAdresvoorstelling.busnummer+%3FbusNumber.+%7D+%3F_address+locn%3ApostCode+%3FpostalCode.+%3F_address+tva%3Agemeentenaam+%3Flocality.+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Fschema%3Aemail+%3Femail.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Fschema%3Atelephone+%3FphoneNumber.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Ffoaf%3Apage+%3FwebsiteAddress.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AcontactPoint%2Fschema%3AcontactType+%3FcontactType.+%7D+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftRegistratie+%3F_registration.+%7D+%3F_registration+dcterms%3Atype+%3F_type.+%3F_type+skos%3AprefLabel+%3Ftype.+%3F_registration+tvl%3AregistratieStatus+%3F_concept.+%3F_concept+skos%3AprefLabel+%3FregistrationStatus.+OPTIONAL+%7B+%3F_lodging+tvl%3AheeftKwaliteitsLabel+%3F_label.+%7D+OPTIONAL+%7B+%3F_lodging+schema%3AstarRating+%3F_starRating.+%7D+OPTIONAL+%7B+%3F_starRating+schema%3AratingValue+%3FstarRating.+%7D+FILTER+%28LANG%28%3FregistrationStatus%29+%3D+%22nl%22%29+FILTER+%28LANG%28%3Ftype%29+%3D+%22nl%22%29+FILTER+%28LANG%28%3Fdescription%29+%3D+%22nl%22%29+%7D';
        $this->assertSame($expected, (string) $request->getBody());
    }
}
