<?php

/**
 * Broker expansion
 * @package Broker
 * @subpackage Expansion
 */
namespace BrokerExpansion;

/**
 * ExplodeExpansion
 */
class ExplodeExpansion implements \Broker\Expansion {
  /**
   * Value
   * @var array|string
   */
  private $value;
  /**
   * Split string
   * @var string
   */
  private $split = ",";
  /**
   * Escape string
   * @var string
   */
  private $escape = "\\";
  /**
   * Trim
   * @var boolean
   */
  private $trim = true;
  
  /**
   * Explode expansion
   * 
   * @param string|array $value          
   * @param object $expansionConfiguration
   * @param object $brokerConfiguration
   * @param object $solrConfiguration
   */
  public function __construct($value, $expansionConfiguration, $brokerConfiguration, $solrConfiguration) {
    $this->value = $value;
    if ($expansionConfiguration && is_object ( $expansionConfiguration )) {
      if (isset ( $expansionConfiguration->parameters ) && is_object ( $expansionConfiguration->parameters )) {
        if (isset ( $expansionConfiguration->parameters->split ) && is_string ( $expansionConfiguration->parameters->split )) {
          $this->split = $expansionConfiguration->parameters->split;
        }
        if (isset ( $expansionConfiguration->parameters->trim )) {
          if ($expansionConfiguration->parameters->trim) {
            $this->trim = true;
          } else {
            $this->trim = false;
          }
        }
      }
    }
  }
  /**
   * {@inheritDoc}
   * @see \Broker\Expansion::cached()
   */
  public static function cached() {
    return false;
  }
  
  /**
   * {@inheritDoc}
   * @see \Broker\Expansion::description()
   */
  public static function description() {
    return "split value";
  }
  /**
   * {@inheritDoc}
   * @see \Broker\Expansion::parameters()
   */
  public static function parameters() {
    return array (
        "split" => "optional, default using \",\"",
        "trim" => "optional, default true" 
    );
  }
  /**
   * {@inheritDoc}
   * @see \Broker\Expansion::getValues()
   */
  public function getValues() {
    $partlist = explode($this->escape.$this->split, $this->value);
    $list = array();
    for($i=0; $i<count($partlist); $i++) {
      $sublist = explode ( $this->split, $partlist[$i] );
      if($i>0) {
        $list[count($list)-1] = $list[count($list)-1].$this->escape.$this->split.$sublist[0];
        for($j=1; $j<count($sublist); $j++) {
          $list[] = $sublist[$j];
        }
      } else {
        $list = $sublist;
      }
    }
    $list = array_map(function($item) {return str_replace("\\\\","\\",str_replace("\\,",",",$item));},$list);
    if ($this->trim) {
      $list = array_map ( "trim", $list );
    }
    return $list;
  }
  /**
   * 
   * {@inheritDoc}
   * @see \Broker\Expansion::getErrors()
   */
  public function getErrors() {
    return null;
  }
}

?>