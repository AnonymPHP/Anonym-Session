<?php
/**
 * This file belongs to the AnoynmFramework
 *
 * @author vahitserifsaglam <vahit.serif119@gmail.com>
 * @see http://gemframework.com
 *
 * Thanks for using
 */


namespace Anonym\Components\Session;

use Anonym\Components\Database\Base;
use Anonym\Components\Database\Managers\BuildManager;
use Anonym\Components\Database\Mode\Delete;
use Anonym\Components\Database\Mode\Read;
use Anonym\Components\Database\Mode\Update;
use Anonym\Components\Database\Mode\Insert;
use SessionHandlerInterface;

class DatabaseSessionHandler implements SessionHandlerInterface
{


    /**
     * the instance of database driver
     *
     * @var Base
     */
    protected $database;

    /**
     * @var string
     */
    protected $table;

    /**
     *  create an instance
     *
     * @param Base $base
     * @param string $table
     */
    public function __construct(Base $base, $table)
    {
        $this->database = $base;
        $this->table = $table;
    }

    /**
     * Close the session
     * @link http://php.net/manual/en/sessionhandlerinterface.close.php
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function close()
    {
        return true;
    }

    /**
     * Destroy a session
     * @link http://php.net/manual/en/sessionhandlerinterface.destroy.php
     * @param string $session_id The session ID being destroyed.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function destroy($session_id)
    {
        $return = $this->database->delete($this->table, function (Delete $delete) use ($session_id) {
            return $delete->where([
                [
                    'key',
                    '=',
                    $session_id,
                ],
            ])->build()->run();
        });

        return $return ? true : false;
    }

    /**
     * Cleanup old sessions
     * @link http://php.net/manual/en/sessionhandlerinterface.gc.php
     * @param int $maxlifetime <p>
     * Sessions that have not updated for
     * the last maxlifetime seconds will be removed.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function gc($maxlifetime)
    {
         return $this->database->query(sprintf('TRUNCATE %s', $this->table)) ? true:false;
    }

    /**
     * Initialize session
     * @link http://php.net/manual/en/sessionhandlerinterface.open.php
     * @param string $save_path The path where to store/retrieve the session.
     * @param string $session_id The session id.
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function open($save_path, $session_id)
    {
        return true;
    }

    /**
     * Read session data
     * @link http://php.net/manual/en/sessionhandlerinterface.read.php
     * @param string $session_id The session id to read data for.
     * @return string <p>
     * Returns an encoded string of the read data.
     * If nothing was read, it must return an empty string.
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function read($session_id)
    {
        $return = $this->database->read($this->table, function (Read $read) use ($session_id) {
            return $read->where([
                ['key', '=', $session_id],
            ])->build();
        });

        if ($return instanceof BuildManager) {
            return $return->rowCount() ? $return->fetch()->value : '';
        }

        return '';
    }

    /**
     * Write session data
     * @link http://php.net/manual/en/sessionhandlerinterface.write.php
     * @param string $session_id The session id.
     * @param string $session_data <p>
     * The encoded session data. This data is the
     * result of the PHP internally encoding
     * the $_SESSION superglobal to a serialized
     * string and passing it as this parameter.
     * Please note sessions use an alternative serialization method.
     * </p>
     * @return bool <p>
     * The return value (usually TRUE on success, FALSE on failure).
     * Note this value is returned internally to PHP for processing.
     * </p>
     * @since 5.4.0
     */
    public function write($session_id, $session_data)
    {

        $count = $this->database->read($this->table, function (Read $read) use ($session_id) {
            return $read->where([
                ['key', '=', $session_id],
            ])->build();
        });

        if (!$count->rowCount()) {
            $return = $this->database->insert($this->table, function (Insert $insert) use ($session_id, $session_data) {
                return $insert->set([
                    'key' => $session_id,
                    'value' => $session_data,
                ])->build()->run();
            });
        } else {
            $return = $this->database->update($this->table, function (Update $update) use ($session_id, $session_data) {
                return $update->where([
                    [
                        'key',
                        '=',
                        $session_id,
                    ],
                ])->set([
                    'value' => $session_data,
                ])->run();
            });
        }

        return $return ? true : false;

    }
}