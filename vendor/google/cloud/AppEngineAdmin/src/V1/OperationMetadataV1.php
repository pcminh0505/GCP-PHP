<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/appengine/v1/operation.proto

namespace Google\Cloud\AppEngine\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Metadata for the given [google.longrunning.Operation][google.longrunning.Operation].
 *
 * Generated from protobuf message <code>google.appengine.v1.OperationMetadataV1</code>
 */
class OperationMetadataV1 extends \Google\Protobuf\Internal\Message
{
    /**
     * API method that initiated this operation. Example:
     * `google.appengine.v1.Versions.CreateVersion`.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string method = 1;</code>
     */
    private $method = '';
    /**
     * Time that this operation was created.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp insert_time = 2;</code>
     */
    private $insert_time = null;
    /**
     * Time that this operation completed.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 3;</code>
     */
    private $end_time = null;
    /**
     * User who requested this operation.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string user = 4;</code>
     */
    private $user = '';
    /**
     * Name of the resource that this operation is acting on. Example:
     * `apps/myapp/services/default`.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string target = 5;</code>
     */
    private $target = '';
    /**
     * Ephemeral message that may change every time the operation is polled.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string ephemeral_message = 6;</code>
     */
    private $ephemeral_message = '';
    /**
     * Durable messages that persist on every operation poll.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>repeated string warning = 7;</code>
     */
    private $warning;
    protected $method_metadata;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $method
     *           API method that initiated this operation. Example:
     *           `google.appengine.v1.Versions.CreateVersion`.
     *           &#64;OutputOnly
     *     @type \Google\Protobuf\Timestamp $insert_time
     *           Time that this operation was created.
     *           &#64;OutputOnly
     *     @type \Google\Protobuf\Timestamp $end_time
     *           Time that this operation completed.
     *           &#64;OutputOnly
     *     @type string $user
     *           User who requested this operation.
     *           &#64;OutputOnly
     *     @type string $target
     *           Name of the resource that this operation is acting on. Example:
     *           `apps/myapp/services/default`.
     *           &#64;OutputOnly
     *     @type string $ephemeral_message
     *           Ephemeral message that may change every time the operation is polled.
     *           &#64;OutputOnly
     *     @type string[]|\Google\Protobuf\Internal\RepeatedField $warning
     *           Durable messages that persist on every operation poll.
     *           &#64;OutputOnly
     *     @type \Google\Cloud\AppEngine\V1\CreateVersionMetadataV1 $create_version_metadata
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Appengine\V1\Operation::initOnce();
        parent::__construct($data);
    }

    /**
     * API method that initiated this operation. Example:
     * `google.appengine.v1.Versions.CreateVersion`.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string method = 1;</code>
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * API method that initiated this operation. Example:
     * `google.appengine.v1.Versions.CreateVersion`.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string method = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setMethod($var)
    {
        GPBUtil::checkString($var, True);
        $this->method = $var;

        return $this;
    }

    /**
     * Time that this operation was created.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp insert_time = 2;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getInsertTime()
    {
        return isset($this->insert_time) ? $this->insert_time : null;
    }

    public function hasInsertTime()
    {
        return isset($this->insert_time);
    }

    public function clearInsertTime()
    {
        unset($this->insert_time);
    }

    /**
     * Time that this operation was created.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp insert_time = 2;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setInsertTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->insert_time = $var;

        return $this;
    }

    /**
     * Time that this operation completed.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 3;</code>
     * @return \Google\Protobuf\Timestamp|null
     */
    public function getEndTime()
    {
        return isset($this->end_time) ? $this->end_time : null;
    }

    public function hasEndTime()
    {
        return isset($this->end_time);
    }

    public function clearEndTime()
    {
        unset($this->end_time);
    }

    /**
     * Time that this operation completed.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>.google.protobuf.Timestamp end_time = 3;</code>
     * @param \Google\Protobuf\Timestamp $var
     * @return $this
     */
    public function setEndTime($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Timestamp::class);
        $this->end_time = $var;

        return $this;
    }

    /**
     * User who requested this operation.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string user = 4;</code>
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * User who requested this operation.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string user = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setUser($var)
    {
        GPBUtil::checkString($var, True);
        $this->user = $var;

        return $this;
    }

    /**
     * Name of the resource that this operation is acting on. Example:
     * `apps/myapp/services/default`.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string target = 5;</code>
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Name of the resource that this operation is acting on. Example:
     * `apps/myapp/services/default`.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string target = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setTarget($var)
    {
        GPBUtil::checkString($var, True);
        $this->target = $var;

        return $this;
    }

    /**
     * Ephemeral message that may change every time the operation is polled.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string ephemeral_message = 6;</code>
     * @return string
     */
    public function getEphemeralMessage()
    {
        return $this->ephemeral_message;
    }

    /**
     * Ephemeral message that may change every time the operation is polled.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>string ephemeral_message = 6;</code>
     * @param string $var
     * @return $this
     */
    public function setEphemeralMessage($var)
    {
        GPBUtil::checkString($var, True);
        $this->ephemeral_message = $var;

        return $this;
    }

    /**
     * Durable messages that persist on every operation poll.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>repeated string warning = 7;</code>
     * @return \Google\Protobuf\Internal\RepeatedField
     */
    public function getWarning()
    {
        return $this->warning;
    }

    /**
     * Durable messages that persist on every operation poll.
     * &#64;OutputOnly
     *
     * Generated from protobuf field <code>repeated string warning = 7;</code>
     * @param string[]|\Google\Protobuf\Internal\RepeatedField $var
     * @return $this
     */
    public function setWarning($var)
    {
        $arr = GPBUtil::checkRepeatedField($var, \Google\Protobuf\Internal\GPBType::STRING);
        $this->warning = $arr;

        return $this;
    }

    /**
     * Generated from protobuf field <code>.google.appengine.v1.CreateVersionMetadataV1 create_version_metadata = 8;</code>
     * @return \Google\Cloud\AppEngine\V1\CreateVersionMetadataV1|null
     */
    public function getCreateVersionMetadata()
    {
        return $this->readOneof(8);
    }

    public function hasCreateVersionMetadata()
    {
        return $this->hasOneof(8);
    }

    /**
     * Generated from protobuf field <code>.google.appengine.v1.CreateVersionMetadataV1 create_version_metadata = 8;</code>
     * @param \Google\Cloud\AppEngine\V1\CreateVersionMetadataV1 $var
     * @return $this
     */
    public function setCreateVersionMetadata($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AppEngine\V1\CreateVersionMetadataV1::class);
        $this->writeOneof(8, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getMethodMetadata()
    {
        return $this->whichOneof("method_metadata");
    }

}
