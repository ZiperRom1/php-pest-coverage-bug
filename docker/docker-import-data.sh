#!/bin/bash

es_data_folder=$(docker volume inspect --format '{{ .Mountpoint }}' social-network-analysis_es-data)
kibana_data_folder=$(docker volume inspect --format '{{ .Mountpoint }}' social-network-analysis_kibana-data)
kibana_config_folder=$(docker volume inspect --format '{{ .Mountpoint }}' social-network-analysis_kibana-config)
root_script_dir=${PWD}

# Import docker volumes from elasticsearch and kibana from resources folder
cd "${es_data_folder}" && tar -xvf "${root_script_dir}"/elasticsearch/es-data.tar
cd "${kibana_data_folder}" && tar -xvf "${root_script_dir}"/kibana/kibana-data.tar
cd "${kibana_config_folder}" && tar -xvf "${root_script_dir}"/kibana/kibana-config.tar
