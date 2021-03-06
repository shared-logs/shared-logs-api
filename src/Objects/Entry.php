<?php
/** Entry */

namespace Battis\SharedLogs\Objects;

use Battis\SharedLogs\AbstractObject;

/**
 * A log entry
 *
 * Log entries are timestamped notes authored by users and referring to a specific device.
 *
 * @property Log log
 * @property User user
 * @author Seth Battis <seth@battis.net>
 */
class Entry extends AbstractObject
{
    /** Suppress log sub-object */
    const SUPPRESS_LOG = false;

    /** Suppress user sub-object */
    const SUPPRESS_USER = false;

    /** Canonical field name for references to entry objects in the database */
    const ID = 'entry_id';

    /**
     * Construct an Entry object from a database record
     *
     * @param array $databaseRecord Associative array of fields
     * @param Log|false $log (Optional) Log sub-object (or `Entry::SUPPRESS_LOG`)
     * @param User|false $user (Optional) User sub-object (or `Entry::SUPPRESS_USER`)
     *
     * @throws \Battis\SharedLogs\Exceptions\ObjectException
     */
    public function __construct($databaseRecord, $log = self::SUPPRESS_LOG, $user = self::SUPPRESS_USER)
    {
        parent::__construct($databaseRecord);

        if ($log instanceof Log) {
            $this->log = $log;
        }
        if ($user instanceof User) {
            $this->user = $user;
        }
    }
}
