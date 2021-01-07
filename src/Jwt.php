<?php namespace Kardigan\LaravelKongJwt;

class Jwt
{

    /**
     * Strip out all non json content
     *
     * @param $claims_string
     * @return array
     */
    public function parseJwtClaimsString($claims_string)
    {
        $pattern = '
/
\{              # { character
    (?:         # non-capturing group
        [^{}]   # anything that is not a { or }
        |       # OR
        (?R)    # recurses the entire pattern
    )*          # previous group zero or more times
\}              # } character
/x
';

        preg_match_all($pattern, $claims_string, $matches);

        $data = [];

        foreach($matches[0] as $match)
        {
            $data[] = json_decode($match);
        }

        return $data;
    }

    /**
     * Get all jwt claims
     *
     * @param $claims
     * @return array
     */
    public function getClaims($claims)
    {
        $claims = $this->parseJwtClaimsString($claims);

        $data = [];

        if(!is_array($claims) && !is_object($claims))
        {
            return $data;
        }

        foreach($claims as $claim_array)
        {
            $claims_array = is_object($claim_array) ? get_object_vars($claim_array) : $claim_array;

            if(is_array($claims_array))
            {
                foreach ($claim_array as $key => $value)
                {
                    $data[$key] = $value;
                }
            }
        }

        return $data;
    }

    public function base64Decode($jwt_token)
    {
        $jwt_token = trim(str_replace('Bearer ', '', $jwt_token));

        return base64_decode($jwt_token);
    }
}