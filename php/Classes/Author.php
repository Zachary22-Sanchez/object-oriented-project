<?php
namespace Zachary22Sanchez\ObjectOrientedProject;

require_once ("autoload.php");
require_once(dirname(__DIR__, 1) ."/vendor/autoload.php");
use Ramsey\Uuid\Uuid;

class Author {
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
	private $authorActivationToken;
	/**
	 * email for this author; this is a unique index
	 * @var string $authorEmail
	 */
	private $authorAvatarUrl;
	/**
	 * avatar url for this author
	 * @var string authorAvatarUrl
	 */
	private $authorEmail;
	/**
	 * hash for profile password
	 * @var $profileHash
	 */
	private $authorHash;
	/**
	 * username for this author
	 * @var $authorHash
	 */
	private $authorUsername;
	/**
	 * username for this author
	 * @var string $authorUsername
	 */
	/**
	 * constructor for this Author
	 *
	 * @param string|Uuid $newAuthorId id of this author if a new author
	 * @param string $newAuthorActivationToken activation token to safe guard against malicious accounts
	 * @param string $newAuthorAvatarUrl string containing
	 * @param string $newAuthorEmail string containing email
	 * @param string $newAuthorHash string containing password hash
	 * @param string $newAuthorUsername string containing author username
	 * @Documentation https://php.net/manual/en/language.oop5.dec
	 */
	public function __construct($newAuthorId, $newAuthorActivationToken, $newAuthorAvatarUrl, $newAuthorEmail, $newAuthorHash, $newAuthorUsername) {
		try {
			$this->setAuthorId($newAuthorId);
			$this->setAuthorActivationToken($newAuthorActivationToken);
			$this->setAuthorAvatarUrl($newAuthorAvatarUrl);
			$this->setAuthorEmail($newAuthorEmail);
			$this->setAuthorHash($newAuthorHash);
			$this->setAuthorUsername($newAuthorUsername);
		} catch(\InvalidArgumentException | \RangeException | \Exception | \TypeError $exception) {
			//determine what exception type was thrown
			$exceptionType = get_class($exception);
			throw(new $exceptionType($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for profile id
	 *
	 * @return Uuid value of this author id (or null if new Author)
	 */
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
 * accessor method for author account activation token
 *
 * @return string value of the author activation token
 */
public function getAuthorActivationToken() : ?string {
	return ($this->authorActivationToken);
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
		$this->authorActivationToken = null;
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
public function getAuthorAvatarUrl(): ?string {
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
public function setAuthorAvatarUrl(?string $newAuthorAvatarUrl) : void {
	if($newAuthorAvatarUrl === null) {
		$this->getAuthorAvatarUrl = null;
		return;
	}
	//verify the at handle is secure
	$newAuthorAvatarUrl = trim($newAuthorAvatarUrl);
	$newAuthorAvatarUrl = filter_var($newAuthorAvatarUrl, FILTER_VALIDATE_URL, );
	if($newAuthorAvatarUrl === false) {
		throw(new \InvalidArgumentException("author url is empty or insecure"));
	}
	if(strlen($newAuthorAvatarUrl) > 255) {
		throw(new \RangeException("avatar is too large"));
	}
	// store  the at handle
	$this->authorAvatarUrl = $newAuthorAvatarUrl;
}
	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 */
	public function getAuthorEmail(): string {
				return $this->authorEmail;
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
	if(empty($newAuthorEmail) === true) {
		throw(new \InvalidArgumentException("profile email is empty or insecure"));
	}
	//verify the email will fit in the database
	if(strlen($newAuthorEmail) > 128) {
		throw(new \RangeException("profile email is too large"));
	}
//store the email
	$this->authorEmail = $newAuthorEmail;
}
	/**
	 * accessor method for authorHash
	 *
	 * @return string value of hash
	 */
	public function getAuthorHash(): string {
		return $this->authorHash;
	}
	/**
	 * mutator method for author hash password
	 *
	 * @param string $newAuthorHash
	 * @throws \InvalidArgumentException if the hash is not secure
	 * @throws \RangeException if the hash is not 128 characters
	 * @throws \TypeError if profile hash is not a string
	 */
	public function setAuthorHash(string $newAuthorHash): void {
	//enforce that the has is properly formatted
	$newAuthorHash = trim($newAuthorHash);
	$newAuthorHash = strtolower($newAuthorHash);
	if(empty($newAuthorHash) === true) {
		throw(new \InvalidArgumentException("author password hash is empty or insecure"));
	}
	//enforce hash is really an Argon hash
	if(!ctype_xdigit($newAuthorHash)) {
		throw(new \InvalidArgumentException("author password hash is empty or insecure"));
	}
	//enforce that the has is exactly 97 characters.
	if(strlen($newAuthorHash) !== 97) {
		throw(new \RangeException("author hash must be 97 characters"));
	}
	//store the hash
	$this->authorHash = $newAuthorHash;
	}

	public function getAuthorUsername(): string {
		return $this->authorUsername;
	}
	/**
	 * mutator method for author username
	 *
	 *@param string $newAuthorUsername new value of username
	 *@throw \InvalidArgumentException if $newUsername is not a string or insecure
	 *@throw \RangeException if $newUserName is > 32 characters
	 *@throws \TypeError if $newUserName is not a string
	 */
	public function setAuthorUsername(string $newAuthorUsername): void {
		//verify the username is secure
		$newAuthorUsername = trim($newAuthorUsername);
		$newAuthorUsername = filter_var($newAuthorUsername, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
		if(empty($newAuthorUsername) > 32) {
			throw(new \RangeException("author username is too large"));
		}
		//store the hash
		$this->authorUsername = $newAuthorUsername;
	}
	/**
	 * formats the state variables for JSON serialization
	 *
	 * @return array resulting state variables to serialize
	 **/
	public function jsonSerialize() {
		$fields = get_object_vars($this);
		$fields["profileId"] = $this->authorId->toString();
		unset($fields["authorHash"]);
		return ($fields);
	}
}

