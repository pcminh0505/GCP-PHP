<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/devtools/artifactregistry/v1beta2/tag.proto

namespace Google\Cloud\ArtifactRegistry\V1beta2;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * The request to create a new tag.
 *
 * Generated from protobuf message <code>google.devtools.artifactregistry.v1beta2.CreateTagRequest</code>
 */
class CreateTagRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * The name of the parent resource where the tag will be created.
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     */
    private $parent = '';
    /**
     * The tag id to use for this repository.
     *
     * Generated from protobuf field <code>string tag_id = 2;</code>
     */
    private $tag_id = '';
    /**
     * The tag to be created.
     *
     * Generated from protobuf field <code>.google.devtools.artifactregistry.v1beta2.Tag tag = 3;</code>
     */
    private $tag = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $parent
     *           The name of the parent resource where the tag will be created.
     *     @type string $tag_id
     *           The tag id to use for this repository.
     *     @type \Google\Cloud\ArtifactRegistry\V1beta2\Tag $tag
     *           The tag to be created.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Devtools\Artifactregistry\V1Beta2\Tag::initOnce();
        parent::__construct($data);
    }

    /**
     * The name of the parent resource where the tag will be created.
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     * @return string
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * The name of the parent resource where the tag will be created.
     *
     * Generated from protobuf field <code>string parent = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setParent($var)
    {
        GPBUtil::checkString($var, True);
        $this->parent = $var;

        return $this;
    }

    /**
     * The tag id to use for this repository.
     *
     * Generated from protobuf field <code>string tag_id = 2;</code>
     * @return string
     */
    public function getTagId()
    {
        return $this->tag_id;
    }

    /**
     * The tag id to use for this repository.
     *
     * Generated from protobuf field <code>string tag_id = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setTagId($var)
    {
        GPBUtil::checkString($var, True);
        $this->tag_id = $var;

        return $this;
    }

    /**
     * The tag to be created.
     *
     * Generated from protobuf field <code>.google.devtools.artifactregistry.v1beta2.Tag tag = 3;</code>
     * @return \Google\Cloud\ArtifactRegistry\V1beta2\Tag|null
     */
    public function getTag()
    {
        return isset($this->tag) ? $this->tag : null;
    }

    public function hasTag()
    {
        return isset($this->tag);
    }

    public function clearTag()
    {
        unset($this->tag);
    }

    /**
     * The tag to be created.
     *
     * Generated from protobuf field <code>.google.devtools.artifactregistry.v1beta2.Tag tag = 3;</code>
     * @param \Google\Cloud\ArtifactRegistry\V1beta2\Tag $var
     * @return $this
     */
    public function setTag($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\ArtifactRegistry\V1beta2\Tag::class);
        $this->tag = $var;

        return $this;
    }

}
