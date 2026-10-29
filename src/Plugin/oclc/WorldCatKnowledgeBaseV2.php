<?php

namespace Drupal\oclc_api\Plugin\oclc;

use Drupal\oclc_api\Annotation\OclcApi;
use Psr\Http\Message\ResponseInterface;

/**
 * Plugin to interact with the WorldCat Knowledge Base API (V2).
 *
 * @OclcApi(
 *   id = "worldcat_knowledge_base_v2",
 *   label = @Translation("WorldCat Knowledge Base API (V2)"),
 *   endpoints = {
 *     "search-collections" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/collections/search",
 *       "query" = {
 *         "alt" = "json",
 *         "q" = "",
 *         "title" = "",
 *         "provider_uid" = "",
 *         "collection_uid" = "",
 *         "search-type" = "",
 *         "startIndex" = "1",
 *         "itemsPerPage" = "25",
 *         "orderBy" = "",
 *       },
 *     },
 *     "read-collection" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/collections/{@collection_uid}",
 *       "query" = {
 *         "alt" = "json",
 *       },
 *     },
 *     "browse-collections" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/collections/browseCollections",
 *       "query" = {
 *         "alt" = "json",
 *         "q" = "",
 *         "search-type" = "atoz",
 *         "institution_id" = "{@institution_id}",
 *         "scope" = "",
 *       },
 *     },
 *     "keyword-search-collections" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/collections/searchCollections",
 *       "query" = {
 *         "alt" = "json",
 *         "q" = "",
 *         "institution_id" = "{@institution_id}",
 *         "scope" = "",
 *       },
 *     },
 *     "search-entries" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/entries/search",
 *       "query" = {
 *         "alt" = "json",
 *         "q" = "",
 *         "title" = "",
 *         "provider_uid" = "",
 *         "collection_uid" = "",
 *         "issn" = "",
 *         "isbn" = "",
 *         "oclcnum" = "",
 *         "content" = "",
 *         "search-type" = "",
 *         "startIndex" = "1",
 *         "itemsPerPage" = "25",
 *         "orderBy" = "",
 *       },
 *     },
 *     "read-entry" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/entries/{@entry_uid}",
 *       "query" = {
 *         "alt" = "json",
 *       },
 *     },
 *     "browse-entries" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/entries/browseEntries",
 *       "query" = {
 *         "alt" = "json",
 *         "search-type" = "atoz",
 *         "institution_id" = "{@institution_id}",
 *         "scope" = "",
 *       },
 *     },
 *     "keyword-search-entries" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/entries/searchEntries",
 *       "query" = {
 *         "alt" = "json",
 *         "q" = "",
 *         "institution_id" = "{@institution_id}",
 *         "scope" = "",
 *       },
 *     },
 *     "search-providers" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/providers/search",
 *       "query" = {
 *         "alt" = "json",
 *         "q" = "",
 *         "title" = "",
 *         "provider_uid" = "",
 *         "startIndex" = "1",
 *         "itemsPerPage" = "25",
 *         "orderBy" = "",
 *       },
 *     },
 *     "read-provider" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/providers/{@provider_uid}",
 *       "query" = {
 *         "alt" = "json",
 *       },
 *     },
 *     "read-settings" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/rest/settings/{@institution_id}",
 *       "query" = {
 *         "alt" = "json",
 *       },
 *     },
 *     "openurl-resolve" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/openurl/resolve",
 *       "query" = {
 *         "svc_id" = "json",
 *         "rft.title" = "",
 *         "rft.btitle" = "",
 *         "rft.jtitle" = "",
 *         "rft.issn" = "",
 *         "rft.eissn" = "",
 *         "rft.isbn" = "",
 *         "rft.oclcnum" = "",
 *         "rft.pub" = "",
 *         "rft.date" = "",
 *         "rft.volume" = "",
 *         "rft.issue" = "",
 *         "rft.spage" = "",
 *         "rft.epage" = "",
 *         "rft.atitle" = "",
 *         "rft.aufirst" = "",
 *         "rft.auinit" = "",
 *         "rft.aulast" = "",
 *         "rft.sici" = "",
 *         "rft.provider_uid" = "",
 *         "rft.collection_uid" = "",
 *         "rft.content" = "",
 *         "rft.institution_id" = "{@institution_id}",
 *         "rft.jkey" = "",
 *         "rft.openaccess" = "",
 *         "rfr_id" = "",
 *         "rft.id" = "",
 *         "rft.force_remote_lookup" = "",
 *       },
 *     },
 *     "openurl-mresolve" = {
 *       "url" = "https://metadata.api.oclc.org/knowledgebase/v1/openurl/mresolve",
 *       "query" = {
 *         "alt" = "json",
 *         "queries" = "",
 *       },
 *     },
 *     "download-kbart" = "https://metadata.api.oclc.org/knowledgebase/v1/export/{@institution_id}/{@kbart_filename}",
 *   },
 *   scopes = {
 *     "kbwcapi",
 *   }
 * )
 *
 * @link https://developer.api.oclc.org/kbv2
 *
 * @package Drupal\oclc_api\Plugin\oclc
 */
class WorldCatKnowledgeBaseV2 extends OclcApiBase {

  /**
   * {@inheritDoc}
   */
  protected function buildHeaders() {
    $token = $this->oclcAuthorizer()
      ->getToken();
    return parent::buildHeaders() + [
      'Authorization' => "Bearer {$token}",
    ];
  }

  /**
   * {@inheritDoc}
   */
  protected function buildUrl(string $endpoint, array $params) {
    $params += ['institution_id' => $this->getInstitutionId()];
    return parent::buildUrl($endpoint, $params);
  }

  /**
   * {@inheritDoc}
   */
  protected function buildUrlQuery(array $endpoint, array $params) {
    // All query parameters are optional; omit any left empty.
    return array_filter(parent::buildUrlQuery($endpoint, $params), function ($value) {
      return $value !== '';
    });
  }

  /**
   * {@inheritDoc}
   */
  protected function buildResponse(ResponseInterface $response) {
    $body = $response->getBody()->getContents();
    // KBART exports are returned as tab-delimited text.
    if (strpos($response->getHeaderLine('Content-Type'), 'json') === FALSE) {
      return $body;
    }
    return json_decode($body);
  }

}
