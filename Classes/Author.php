<?php

namespace Zachary22-Sanchez/ObjectOrientedProject;

class Author  {
	use ValidateUuid;
	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $authorId;
	/**
	 * at handle for this Profile; this is a unique index
	 * @var string $profileAtHandle
	 **/
	private $authorAvatarUrl;
	/**
	 * token handed out to verify that the profile is valid and not malicious.
	 *v@var $profileActivationToken
	 **/
	private $authorActivationToken;
	/**
	 * token handed out to verify that the profile is valid and not malicious.
	 *v@var $authorActivationToken
	 **/
	private $authorEmail;
	/**
	 * email for this Profile; this is a unique index
	 * @var string $authorEmail
	 **/
	private $authorHash;
	/**
	 * hash for this password
	 * @var $authorHash
	 **/
	private $authorUsername;
	/**
	 * salt for profile password
	 *
	 * @var $profileSalt
	 */
	private $profileSalt;
