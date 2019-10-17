<?php

namespace Zachary22-Sanchez/ObjectOrientedProject;

require_once(dirname(__DIR__, 2) . "/vendor/autoload.php");

use Ramsey\Uuid\Uuid;

class Author  {
	use ValidateUuid;
	/**
	 * id for this Profile; this is the primary key
	 * @var Uuid $profileId
	 **/
	private $authorId;
	/**
	 * at handle for this Profile; this is a unique index
	 * @var string $authorAtHandle
	 **/
	public function getAuthorId(): Uuid {
		return ($this->authorId);
	}
/**
 * mutator method for author id
 *
 * @param Uuid| string $newAuthorId value of new author id
 * @throws \RangeException if $newAuthorId is not positive
 * @throws \TypeError if the profile Id is not
 */
public function setAuthorId( $newAuthorId): void {
	try {
		$uuid = self::validateUuid($newAuthorId);
	} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
		$exceptionType = get_class($exception);
		throw(new $exceptionType($exception->getMessage(), 0, $exception));
	}
	//convert and store the author id
	$this->authorId = $uuid;
}
/**
 * accessor method for account activation token
 *
 * @return string value of the activation token
 */
public function getProfileActivationToken() : ?string {
	return ($this->getAuthorActivationToken);
}
/**
 *mutator method for account activation token
 *
 *@param string $newAuthorActivationToken
 *@throws \InvalidArgumentException if the token is not a string or insecure
 *@throws \RangeException if the token is not exactly 32 characters
 *@throws \TypeError if the activation token is not a string
 */
public function setAuthorActivationToken(?string $newAuthorActivationToken): void {
	if($newAuthorActivationToken === null) {
		$this->setAuthorActivationToken = null;
		return;
	}
	$newAuthorActivationToken = strtolower(trim($newAuthorActivationToken));
	if(ctype_xdigit($newAuthorActivationToken) === false) {
		throw(new\RangeException("user activation is not valid"));
	}
	//make sure user activation token is only 32 characters
	if(strlen($newAuthorActivationToken) !== 32) {
		throw(new\RangeException("user activation token has to be 32"));
	}
	$this->authorActivationToken = $newAuthorActivationToken;
}
/**
 * accessor method for at handle
 *
 * @return string value of at handle
 */
public function authorAvatarUrl(): string {
	return ($this->authorAvatarUrl);
}
/**
 *mutator method for at handle
 *
 *@param string $newAuthorAvatarUrl new value of at handle
 *@throws \InvalidArgumentException if $newAtHandle is not a string or insecure
 *@throws \RangeException if $newAtHandle is > 32 characters
 *@throws \TypeError if $newAtHandle is not a string
 */
public function setAuthorAvatarUrl(string $newAuthorAvatarUrl) : void {
	//verify the at handle is secure
	$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
	$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
	if(empty($authorAvatarUrl) === true) {
		throw(new \InvalidArgumentException("profile at handle is empty or insecure"));
	}
	// store the at handle
	$this->authorAvatarUrl = $newAuthorAvatarUrl;
}
/**
 * mutator method for email
 *
 * @param string $newAuthorEmail new value of email
 * @throws \InvalidArgumentException if $newEmail is not valid email or insecure
 * @throws \RangeException if $newEmail is > 128 characters
 * @throws \TypeError if $newEmail is not a string
 */
public function setAuthorEmail(string $newAuthorEmail): void {
	//verify the email is secure
	$newAuthorEmail = trim($newAuthorEmail);
	$newAuthorEmail = filter_var($newAuthorEmail, FILTER_VALIDATE_EMAIL);
	if (empty($newAuthorEmail) === true) {
		throw(new \InvalidArgumentException("profile email is empty or insecure"));
	}
	//verify the email will fit in the database
	if(strlen($newAuthorEmail) > 128) {}
	throw(new \RangeException("profile email is too large"));
}
//store the email
$this->authorEmail = $newAuthorEmail;
	}
	/**
	 * access method for Author hash password
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the has is not secure
	 * @throws \RangeException if the has is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setAuthorHash(string $newAuthorHash): void {
	//enforce that the has is properly formatted
	$newAuthorHash = trim($newAuthorHash);
	if(empty($newAuthorHash) === true) {
		throw(new \InvalidArgumentException("profile password hash is empty or insecure"));
	}
	//enforce hash is really an Argon hash
	$authorHashInfo = password_get_info($newAuthorHash);
	if($newAuthorHash["algoName"] !== "argon2i") {
		throw(new \InvalidArgumentException("profile is not a valid hash"));
	}
	//enforce that the has is exactly 97 characters.
	if(strlen($newAuthorHash) !== 97) {
		throw(new \RangeException("profile hash must be 97 characters"));
	}
	//store the hash
	$this->AuthorHash = $newAuthorHash;
	}
	/**
	 * mutator method for username
	 *
	 *@param string $newAuthorUserName new value of username
	 *@throw
	 */
}