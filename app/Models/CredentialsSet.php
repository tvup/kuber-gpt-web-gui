<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int $id
 * @property User $user
 * @property Credential[] $credentials
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class CredentialsSet extends Model
{
    public const PINECONE_API_KEY = "pinecone_api_key";
    public const PINECONE_ENV = "pinecone_env";
    public const OPENAI_API_KEY = "openai_api_key";
    public const ELEVENLABS_API_KEY = "elevenlabs_api_key";
    public const ELEVENLABS_VOICE_1_ID = "elevenlabs_voice_1_id";
    public const ELEVENLABS_VOICE_2_ID = "elevenlabs_voice_2_id";
    public const SMART_LLM_MODEL = "smart_llm_model";
    public const FAST_LLM_MODEL = "fast_llm_model";
    public const GOOGLE_API_KEY = "google_api_key";
    public const CUSTOM_SEARCH_ENGINE_ID = "custom_search_engine_id";
    public const USE_AZURE = "use_azure";
    public const OPENAI_AZURE_API_BASE = "openai_azure_api_base";
    public const OPENAI_AZURE_API_VERSION = "openai_azure_api_version";
    public const OPENAI_AZURE_DEPLOYMENT_ID = "openai_azure_deployment_id";
    public const IMAGE_PROVIDER = "image_provider";
    public const HUGGING_FACE_API_TOKEN = "hugging_face_api_token";
    public const USE_MAC_OS_TTS = "use_mac_os_tts";
    public const MEMORY_BACKEND = "memory_backend";
    public const REDIS_HOST = "redis_host";
    public const REDIS_PORT = "redis_port";
    public const REDIS_PASSWORD = "redis_password";
    public const WIPE_REDIS_ON_START = "wipe_redis_on_start";
    public const UID = "uid";
    public const GID = "gid";
    public const EXECUTE_LOCAL_COMMANDS = "execute_local_commands";
    public const COMMAND_LINE_PARAMS = "command_line_params";
    public const COMPOSE_PROJECT_NAME = "compose_project_name";
    public const FORWARD_REDIS_PORT = "forward_redis_port";
    public const FORWARD_APP_PORT = "forward_app_port";
    public const RESTRICT_TO_WORKSPACE = "restrict_to_workspace";
    public const RAPID_API_KEY = "rapid_api_key";
    public const U_COOKIE = "u_cookie";
    public const CHAT_HISTORY_FILE = "chat_history_file";

    /**
     * @var array|string[]
     */
    public static array $keys = [self::PINECONE_API_KEY,
        self::PINECONE_ENV,
        self::OPENAI_API_KEY,
        self::ELEVENLABS_API_KEY,
        self::ELEVENLABS_VOICE_1_ID,
        self::ELEVENLABS_VOICE_2_ID,
        self::SMART_LLM_MODEL,
        self::FAST_LLM_MODEL,
        self::GOOGLE_API_KEY,
        self::CUSTOM_SEARCH_ENGINE_ID,
        self::USE_AZURE,
        self::OPENAI_AZURE_API_BASE,
        self::OPENAI_AZURE_API_VERSION,
        self::OPENAI_AZURE_DEPLOYMENT_ID,
        self::IMAGE_PROVIDER,
        self::HUGGING_FACE_API_TOKEN,
        self::USE_MAC_OS_TTS,
        self::MEMORY_BACKEND,
        self::REDIS_HOST,
        self::REDIS_PORT,
        self::REDIS_PASSWORD,
        self::WIPE_REDIS_ON_START,
        self::UID,
        self::GID,
        self::EXECUTE_LOCAL_COMMANDS,
        self::COMMAND_LINE_PARAMS,
        self::COMPOSE_PROJECT_NAME,
        self::FORWARD_REDIS_PORT,
        self::FORWARD_APP_PORT,
        self::RESTRICT_TO_WORKSPACE,
        self::RAPID_API_KEY,
        self::U_COOKIE,
        self::CHAT_HISTORY_FILE];

    use HasFactory;

    /**
     * @return BelongsTo<User, CredentialsSet>
     */
    public function user(): BelongsTo
    {
        define("PINECONE_API_KEY", "pinecone_api_key");
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Credential::class>
     */
    public function credentials(): HasMany
    {
        return $this->hasMany(Credential::class);
    }

}
