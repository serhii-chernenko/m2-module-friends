<?php

namespace Course\Backend\Api\Data;

interface FriendInterface
{
    const TABLE_NAME = 'course_backend_friends';
    const FIELD_ID = 'id';
    const FIELD_NAME = 'name';
    const FIELD_AGE = 'age';
    const FIELD_NOTES = 'notes';
    const FIELD_CREATED = 'created';
    const FIELD_UPDATED = 'updated';

    /**
     * @return integer|null
     */
    public function getId(): ?int;

    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param string $name
     * @return $this
     */
    public function setName(string $name): FriendInterface;

    /**
     * @return string|integer
     */
    public function getAge();

    /**
     * @param string|integer $age
     * @return $this
     */
    public function setAge($age): FriendInterface;

    /**
     * @return string
     */
    public function getNotes(): string;

    /**
     * @param string $notes
     * @return $this
     */
    public function setNotes(string $notes): FriendInterface;

    /**
     * @return string
     */
    public function getCreated(): string;

    /**
     * @return string
     */
    public function getUpdated(): string;
}
