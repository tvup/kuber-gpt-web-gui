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
 * @property RunSet $runSet
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
    public const BROWSE_CHUNK_MAX_LENGTH = "browse_chunk_max_length";
    public const BROWSE_SUMMARY_MAX_TOKEN = "browse_summary_max_token";
    public const USER_AGENT = "user_agent";
    public const AI_SETTINGS_FILE = "ai_settings_file";
    public const USE_WEB_BROWSER = "use_web_browser";
    public const TEMPERATURE = "temperature";
    public const FAST_TOKEN_LIMIT = "fast_token_limit";
    public const SMART_TOKEN_LIMIT = "smart_token_limit";
    public const MEMORY_INDEX = "memory_index";
    public const WEAVIATE_HOST = "weaviate_host";
    public const WEAVIATE_PORT = "weaviate_port";
    public const WEAVIATE_PROTOCOL = "weaviate_protocol";
    public const USE_WEAVIATE_EMBEDDED = "use_weaviate_embedded";
    public const WEAVIATE_EMBEDDED_PATH = "weaviate_embedded_path";
    public const WEAVIATE_USERNAME = "weaviate_username";
    public const WEAVIATE_PASSWORD = "weaviate_password";
    public const WEAVIATE_API_KEY = "weaviate_api_key";
    public const MILVUS_ADDR = "milvus_addr";
    public const MILVUS_COLLECTION = "milvus_collection";
    public const HUGGINGFACE_API_TOKEN = "huggingface_api_token";
    public const HUGGINGFACE_AUDIO_TO_TEXT_MODEL = "huggingface_audio_to_text_model";
    public const GITHUB_API_KEY = "github_api_key";
    public const GITHUB_USERNAME = "github_username";
    public const USE_BRIAN_TTS = "use_brian_tts";
    public const TW_CONSUMER_KEY = "tw_consumer_key";
    public const TW_CONSUMER_SECRET = "tw_consumer_secret";
    public const TW_ACCESS_TOKEN = "tw_access_token";
    public const TW_ACCESS_TOKEN_SECRET = "tw_access_token_secret";

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
        self::CHAT_HISTORY_FILE,
        self::BROWSE_CHUNK_MAX_LENGTH,
        self::BROWSE_SUMMARY_MAX_TOKEN,
        self::USER_AGENT,
        self::AI_SETTINGS_FILE,
        self::USE_WEB_BROWSER,
        self::TEMPERATURE,
        self::FAST_TOKEN_LIMIT,
        self::SMART_TOKEN_LIMIT,
        self::MEMORY_INDEX,
        self::WEAVIATE_HOST,
        self::WEAVIATE_PORT,
        self::WEAVIATE_PROTOCOL,
        self::USE_WEAVIATE_EMBEDDED,
        self::WEAVIATE_EMBEDDED_PATH,
        self::WEAVIATE_USERNAME,
        self::WEAVIATE_PASSWORD,
        self::WEAVIATE_API_KEY,
        self::MILVUS_ADDR,
        self::MILVUS_COLLECTION,
        self::HUGGINGFACE_API_TOKEN,
        self::HUGGINGFACE_AUDIO_TO_TEXT_MODEL,
        self::GITHUB_API_KEY,
        self::GITHUB_USERNAME,
        self::USE_BRIAN_TTS,
        self::TW_CONSUMER_KEY,
        self::TW_CONSUMER_SECRET,
        self::TW_ACCESS_TOKEN,
        self::TW_ACCESS_TOKEN_SECRET,
    ];

    use HasFactory;

    /**
     * @return BelongsTo<User, CredentialsSet>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany<Credential::class>
     */
    public function credentials(): HasMany
    {
        return $this->hasMany(Credential::class);
    }

    /**
     * @return BelongsTo<RunSet, CredentialsSet>
     */
    public function runSet(): BelongsTo
    {
        return $this->belongsTo(RunSet::class);
    }

}
